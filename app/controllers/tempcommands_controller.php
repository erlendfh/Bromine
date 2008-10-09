<?php
class TempcommandsController extends AppController {

	var $name = 'Tempcommands';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Tempcommand->recursive = 0;
		$this->set('tempcommands', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Tempcommand.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('tempcommand', $this->Tempcommand->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Tempcommand->create();
			if ($this->Tempcommand->save($this->data)) {
				$this->Session->setFlash(__('The Tempcommand has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Tempcommand could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Tempcommand', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Tempcommand->save($this->data)) {
				$this->Session->setFlash(__('The Tempcommand has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Tempcommand could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Tempcommand->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Tempcommand', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Tempcommand->del($id)) {
			$this->Session->setFlash(__('Tempcommand deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>