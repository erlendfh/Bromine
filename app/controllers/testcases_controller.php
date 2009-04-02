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

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Testcase.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('testcase', $this->Testcase->read(null, $id));
		$testcasesteps = $this->Testcase->TestcaseStep->findAll(array('testcase_id' => $id),null,array('order by' => 'TestcaseStep.orderby'));
    	$this->set('testcasesteps',$testcasesteps);
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
		$this->set(compact('requirements', 'projects'));
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
			
			//Testscript part
			pr($this->data);
			if($this->data['Testcase']['testscript']['name']!=''){
                $ext = end(explode('.', $this->data['Testcase']['testscript']['name']));
                $uploadfile = WWW_ROOT.DS.'tests'.DS.$this->Session->read('project_name').DS.$ext.DS.$id.".$ext";
                App::import('Model','Type');
                $this->Type = new Type();
                $extList = $this->Type->find('list', array('fields' => array('Type.extension')));
                if(in_array($ext, $extList)){
                    if (move_uploaded_file($this->data['Testcase']['testscript']['tmp_name'], $uploadfile)) {
                        $this->setFlash(__('The Testscript has been uploaded',true), 'succ');
        			}else{
                        $this->setFlash(__('Script not uploaded. The file could not be uploaded. Check folder permissions', true),'err');
                    }
                }else{
                    $this->setFlash(__('Script not uploaded. Filetype not accepted. The accepted filetypes are '.implode(', ', $extList), true), 'err');
                }
    		}
    		
    		//pr($this->Session);
		}
        if($id){
    		$this->data = $this->Testcase->read(null, $id);
    		//$testcasesteps = $this->Testcase->TestcaseStep->find('list');
    		$testcasesteps = $this->Testcase->TestcaseStep->findAll(array('testcase_id' => $id),null,array('order by' => 'TestcaseStep.orderby'));
    		$this->set('testcasesteps',$testcasesteps);
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
