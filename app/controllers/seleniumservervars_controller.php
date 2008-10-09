<?php
class SeleniumservervarsController extends AppController {

	var $name = 'Seleniumservervars';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Seleniumservervar->recursive = 0;
		$this->set('seleniumservervars', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Seleniumservervar.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('seleniumservervar', $this->Seleniumservervar->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Seleniumservervar->create();
			if ($this->Seleniumservervar->save($this->data)) {
				$this->Session->setFlash(__('The Seleniumservervar has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Seleniumservervar could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Seleniumservervar', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Seleniumservervar->save($this->data)) {
				$this->Session->setFlash(__('The Seleniumservervar has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Seleniumservervar could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Seleniumservervar->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Seleniumservervar', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Seleniumservervar->del($id)) {
			$this->Session->setFlash(__('Seleniumservervar deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>