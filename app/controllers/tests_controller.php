<?php
class TestsController extends AppController {

	var $name = 'Tests';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Test->recursive = 0;
		$this->set('tests', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Test.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('test', $this->Test->read(null, $id));
	}

}
?>
