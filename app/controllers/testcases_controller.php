<?php
class TestcasesController extends AppController {

	var $name = 'Testcases';
	var $helpers = array('Html', 'Form', 'Table');

	function index() {
		$this->Testcase->recursive = 0;
		$this->set('testcases', $this->paginate(null, array('Project.id' => $this->Session->read('project_id'))));
	}
	
	function lilist($search=null) {

        $conditions = array('Project.id' => $this->Session->read('project_id'));
        if(!empty($this->data['tcsearch'])){
            $conditions['Testcase.name  LIKE'] = $this->data['tcsearch']."%";
        }

		$this->Testcase->recursive = 0;
		$this->set('testcases', $this->Testcase->find('all',array('conditions'=>$conditions)));
	}


	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Testcase.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('testcase', $this->Testcase->read(null, $id));
		$testcasesteps = $this->Testcase->TestcaseStep->findAll(array('testcase_id' => $id),null,array('order by' => 'TestcaseStep.orderby'));
    	$this->set('testcasesteps',$testcasesteps);
    	if($script=$this->getTestScript($id)){
    	   $this->set('testscript',$script);
    	}
	}
	
	function testlabview($id = null, $requirement_id) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Testcase.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('testcase', $this->Testcase->read(null, $id));
		$testcasesteps = $this->Testcase->TestcaseStep->findAll(array('testcase_id' => $id),null,array('order by' => 'TestcaseStep.orderby'));
    	$this->set('testcasesteps',$testcasesteps);

        $this->Testcase->Requirement->Behaviors->attach('Containable');
		$requirement = $this->Testcase->Requirement->find('first', array(
            'conditions'=>array(
                'Requirement.id'=>$requirement_id
            ),
        	'contain'=>array(
        	    'Testcase',
        		'Combination' => array(
        			'Browser',
        			'Operatingsystem'
        		)
        	)
        ));

        foreach ($requirement['Combination'] as &$combination){
            $combination['Result'] = $this->Testcase->Test->getLastInCombination($id, $combination['Operatingsystem']['id'], $combination['Browser']['id']);
        }
        $this->set('combinations',$requirement['Combination']);
	}
	
	function viewscript($id = null) {
        $this->layout = 'green_blank';
		if (!$id) {
			$this->Session->setFlash(__('Invalid Testcase.', true));
			$this->redirect(array('action'=>'index'));
		}else{
            $this->set('testscript',$this->getTestScript($id));
        }
	}

	function add() {
		if (!empty($this->data)) {
			$this->Testcase->create();
			if ($this->Testcase->save($this->data)) {
				$this->Session->setFlash(__('The Testcase has been saved', true));
				$this->redirect(
    				array(
    				    'controller'=>'requirements#/testcases',
    				    'action' => 'edit',
    				    $this->Testcase->id
                    )
                );
			} else {
				$this->Session->setFlash(__('The Testcase could not be saved. Please, try again.', true));
			}
		}
		$projects = $this->Testcase->Project->find('list');
	}

	function edit($id = null) {
        $this->Testcase->recursive = 0;
		if (!$id && empty($this->data)) {
			$this->setFlash(__('Invalid Testcase', true),'err');
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)){
            if ($this->Testcase->save($this->data)) {
				$this->setFlash(__('The Testcase has been saved', true), 'succ');
			} else {
				$this->setFlash(__('The Testcase could not be saved. Please, try again.', true), 'err');
			}
		}
        if($id){
    		$this->data = $this->Testcase->read(null, $id);
    		$testcasesteps = $this->Testcase->TestcaseStep->findAll(array('testcase_id' => $id),null,array('order by' => 'TestcaseStep.orderby'));
    		$this->set('testcasesteps',$testcasesteps);
        	if($script=$this->getTestScript($id)){
        	   $this->set('testscript',$script);
        	}
		}
	}
	
	private function getTestScript($id){
        App::import('Model','Type');
        $this->Type = new Type();
        $extList = $this->Type->find('list', array('fields' => array('Type.extension')));
        foreach($extList as $ext){
            $file = WWW_ROOT.DS.'testscripts'.DS.$this->Session->read('project_name').DS.$ext.DS.$id.".$ext";
            if(file_exists($file)){
                return htmlspecialchars(file_get_contents($file));
            }
        }
        return false;
    }
	
	function upload($id = null){
        $this->layout = 'green_blank';	   
        if($id){
            $this->set('id',$id);
            if($this->data['Testcase']['testscript']['name']!=''){
                $ext = end(explode('.', $this->data['Testcase']['testscript']['name']));
                $dir = WWW_ROOT.'testscripts'.DS.$this->Session->read('project_name').DS.$ext;                
                if(!file_exists($dir)){
                    mkdir($dir, 0777, true);
                }
                $uploadfile = $dir.DS.$id.".$ext";
                App::import('Model','Type');
                $this->Type = new Type();
                $extList = $this->Type->find('list', array('fields' => array('Type.extension')));
                if(in_array($ext, $extList)){
                    if (move_uploaded_file($this->data['Testcase']['testscript']['tmp_name'], $uploadfile)) {
                        $this->setFlash(__('The Testscript has been uploaded',true), 'succ');
                        $this->set('uploaded',true);
        			}else{
                        $this->setFlash(__('Script not uploaded. The file could not be uploaded. Check folder permissions', true),'err');
                    }
                }else{
                    $this->setFlash(__('Script not uploaded. Filetype not accepted. The accepted filetypes are '.implode(', ', $extList), true), 'err');
                }
    		}
    	}else{
            $this->setFlash('No testcase id provided','err');
        }
    }

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Testcase', true));
			$this->redirect(array('controller'=>'requirements','action'=>'index'));
		}
		if ($this->Testcase->del($id)) {
			$this->Session->setFlash(__('Testcase deleted', true));
			$this->redirect(array('controller'=>'requirements','action'=>'index'));
		}
	}

}
?>
