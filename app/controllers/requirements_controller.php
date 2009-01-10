<?php
class RequirementsController extends AppController {

	var $name = 'Requirements';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Requirement->recursive = 0;
		$this->set('requirements', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Requirement.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('requirement', $this->Requirement->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Requirement->create();
			if ($this->Requirement->save($this->data)) {
				$this->Session->setFlash(__('The Requirement has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Requirement could not be saved. Please, try again.', true));
			}
		}
		$testcases = $this->Requirement->Testcase->find('list');
		$projects = $this->Requirement->Project->find('list');
		$this->set(compact('testcases', 'projects'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Requirement', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Requirement->save($this->data)) {
				$this->Session->setFlash(__('The Requirement has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Requirement could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Requirement->read(null, $id);
		}
		$testcases = $this->Requirement->Testcase->find('list');
		$projects = $this->Requirement->Project->find('list');
		$this->set(compact('testcases','projects'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Requirement', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Requirement->del($id)) {
			$this->Session->setFlash(__('Requirement deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>