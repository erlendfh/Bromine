<?php
class ConfigsController extends AppController {

	var $name = 'Configs';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Config->recursive = 0;
		$this->set('configs', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Config.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('config', $this->Config->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Config->create();
			if ($this->Config->save($this->data)) {
				$this->Session->setFlash(__('The Config has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Config could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Config', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Config->save($this->data)) {
				$this->Session->setFlash(__('The Config has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Config could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Config->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Config', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Config->del($id)) {
			$this->Session->setFlash(__('Config deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>