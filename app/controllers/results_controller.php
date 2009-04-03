<?php
class ResultsController extends AppController {

	var $name = 'Results';
	var $helpers = array('Html', 'Form', 'Treeresults');
	var $uses = array('Requirement');

	function index() {
	    
		$this->Requirement->recursive = 1;
		//pr($this->Requirement->find('threaded'));
		$this->set('data',$this->Requirement->find('threaded'));
		//$this->set('data',$this->Requirement->find('all',array('conditions' => array('Requirement.project_id' => $this->Session->read('project_id')))));
		//$this->set('requirements', $this->paginate(null, array('project.id' => $this->Session->read('project_id'))));
		
	}

	function viewresult($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Requirement.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('requirement', $this->Requirement->read(null, $id));
	}

}
?>
