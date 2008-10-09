<?php
class CoretestsuitesController extends AppController {

	var $name = 'Coretestsuites';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Coretestsuite->recursive = 0;
		$this->set('coretestsuites', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Coretestsuite.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('coretestsuite', $this->Coretestsuite->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Coretestsuite->create();
			if ($this->Coretestsuite->save($this->data)) {
				$this->Session->setFlash(__('The Coretestsuite has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Coretestsuite could not be saved. Please, try again.', true));
			}
		}
		$projects = $this->Coretestsuite->Project->find('list');
		$this->set(compact('projects'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Coretestsuite', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Coretestsuite->save($this->data)) {
				$this->Session->setFlash(__('The Coretestsuite has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Coretestsuite could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Coretestsuite->read(null, $id);
		}
		$projects = $this->Coretestsuite->Project->find('list');
		$this->set(compact('projects'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Coretestsuite', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Coretestsuite->del($id)) {
			$this->Session->setFlash(__('Coretestsuite deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>