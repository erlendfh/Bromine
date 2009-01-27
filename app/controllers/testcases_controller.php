<?php
class TestcasesController extends AppController {

	var $name = 'Testcases';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Testcase->recursive = 0;
		$this->set('testcases', $this->paginate(null, array('project.id' => $this->Session->read('project_id'))));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Testcase.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('testcase', $this->Testcase->read(null, $id));
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
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Testcase', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Testcase->save($this->data)) {
				$this->Session->setFlash(__('The Testcase has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Testcase could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Testcase->read(null, $id);
		}
		$requirements = $this->Testcase->Requirement->find('list');
		$projects = $this->Testcase->Project->find('list');
		$this->set(compact('requirements','projects'));
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