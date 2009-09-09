<?php
class TestsController extends AppController {

	var $name = 'Tests';
	var $helpers = array('Html', 'Form');

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Test.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('test', $this->Test->read(null, $id));
	}

}
?>
