<?php
class TestlabsController extends AppController {

	var $name = 'Testlabs';
	var $helpers = array('Html', 'Form','Tree');
    var $needsproject = true;
    var $uses = array();

  
    
	function index() {
        App::import('Model','Requirement');
        $this->Requirement = new Requirement();
		$this->Requirement->recursive = 1;
		//pr($this->Requirement->find('threaded'));
		$this->set('data',$this->Requirement->find('threaded'));
		//$this->set('data',$this->Requirement->find('all',array('conditions' => array('Requirement.project_id' => $this->Session->read('project_id')))));
		//$this->set('requirements', $this->paginate(null, array('project.id' => $this->Session->read('project_id'))));
		
	}



}
?>
