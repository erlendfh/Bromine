<?php
class TestcasesController extends AppController {

	var $name = 'Testcases';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Testcase->recursive = 0;
		$this->set('testcases', $this->paginate(null, array('project.id' => $this->Session->read('project_id'))));
	}
	
	function lilist($search=null) {

        $conditions = array('project.id' => $this->Session->read('project_id'));
        if(!empty($this->data['tcsearch'])){
            $conditions['testcase.name  LIKE'] = $this->data['tcsearch']."%";
        }

		$this->Testcase->recursive = 0;
		$this->set('testcases', $this->Testcase->find('all',array('conditions'=>$conditions)));
	}

	function viewresult($id = null, $browser = null, $os = null) {
	
	   App::import('Model','Test');
	   $this->Test = new Test();
	   $this->Test->recursive = 0;
		if (!$id) {
			$this->Session->setFlash(__('Invalid Testcase.', true));
			$this->redirect(array('action'=>'index'));
		}
		$conditions = array('Test.testcase_id' => $id);
		if (!$os == null){
            $conditions['Test.operatingsystem_id'] = $os;
        }

		if (!$browser == null){
            $conditions['Test.browser_id'] = $browser;
        }
		
        //pr($conditions);
		
		$sql = array(
        	'conditions' => $conditions, //array of conditions
        	//'recursive' => 1, //int
        	//'fields' => array('Model.field1', 'Model.field2'), //array of field names
        	'order' => array('Test.id DESC'), //string or array defining order
        	//'group' => array('Model.field'), //fields to GROUP BY
        	'limit' => 5 //int
        	//'callbacks' => true //other possible values are false, 'before', 'after'
        );
		
		$this->set('testresults', $this->Test->find('all', $sql));
		//$testcasesteps = $this->Testcase->TestcaseStep->findAll(array('testcase_id' => $id),null,array('order by' => 'TestcaseStep.orderby'));
    	//$this->set('testcasesteps',$testcasesteps);
	}
	
	function showMatrix(){
        App::import('Model','Browsers');
        App::import('Model','Operatingsystem');
        $browser = new Browser();
        $os = new Operatingsystem();
        
        //$conditions = array('Test.testcase_id' => $id);
        $sql = array(
        	//'conditions' => $conditions, //array of conditions
        	//'recursive' => 1, //int
        	//'fields' => array('Model.field1', 'Model.field2'), //array of field names
        	'order' => array('Test.id DESC'), //string or array defining order
        	//'group' => array('Model.field'), //fields to GROUP BY
        	'limit' => 5 //int
        	//'callbacks' => true //other possible values are false, 'before', 'after'
        );
		
		$allBrowsers = $browser->find('all');
		$allOs = $os->find('all');
        
        //echo count($allBrowsers);
        //pr($allOs);
        //exit;
        foreach ($allOs as $value1) {
            foreach ($allBrowsers as $value2) {
                echo $value1['Operatingsystem']['name']. " - " . $value2['Browser']['name'] . "<br />";
            }
        }

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
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Testcase could not be saved. Please, try again.', true));
			}
		}
		$requirements = $this->Testcase->Requirement->find('list');
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
                $uploadfile = WWW_ROOT.DS.'tests'.DS.$this->Session->read('project_name').DS.$ext.DS.$id.".$ext";
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
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Testcase->del($id)) {
			$this->Session->setFlash(__('Testcase deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>
