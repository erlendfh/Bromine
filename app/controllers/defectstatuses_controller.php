<?php
class DefectstatusesController extends AppController {

	var $name = 'Defectstatuses';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Defectstatus->recursive = 0;
		$this->set('defectstatuses', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Defectstatus.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('defectstatus', $this->Defectstatus->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Defectstatus->create();
			if ($this->Defectstatus->save($this->data)) {
				$this->Session->setFlash(__('The Defectstatus has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Defectstatus could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Defectstatus', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Defectstatus->save($this->data)) {
				$this->Session->setFlash(__('The Defectstatus has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Defectstatus could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Defectstatus->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Defectstatus', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Defectstatus->del($id)) {
			$this->Session->setFlash(__('Defectstatus deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>