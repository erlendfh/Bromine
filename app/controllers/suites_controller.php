<?php
class SuitesController extends AppController {

	var $name = 'Suites';
	var $helpers = array('Html', 'Form');
	var $echelon = false;

	function view($id = null) {
	   $this->Suite->recursive = 2;
		if (!$id) {
			$this->Session->setFlash(__('Invalid Suite.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('Suite', $this->Suite->read(null, $id));
	}

}
?>
