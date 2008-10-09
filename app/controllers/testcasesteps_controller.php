<?php
class TestcasestepsController extends AppController {

	var $name = 'Testcasesteps';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Testcasestep->recursive = 0;
		$this->set('testcasesteps', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Testcasestep.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('testcasestep', $this->Testcasestep->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Testcasestep->create();
			if ($this->Testcasestep->save($this->data)) {
				$this->Session->setFlash(__('The Testcasestep has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Testcasestep could not be saved. Please, try again.', true));
			}
		}
		$testcases = $this->Testcasestep->Testcase->find('list');
		$this->set(compact('testcases'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Testcasestep', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Testcasestep->save($this->data)) {
				$this->Session->setFlash(__('The Testcasestep has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Testcasestep could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Testcasestep->read(null, $id);
		}
		$testcases = $this->Testcasestep->Testcase->find('list');
		$this->set(compact('testcases'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Testcasestep', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Testcasestep->del($id)) {
			$this->Session->setFlash(__('Testcasestep deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>