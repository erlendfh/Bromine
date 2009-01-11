<?php
class TypesController extends AppController {

	var $name = 'Types';
	var $helpers = array('Html', 'Form');
	var $layout = "admin";

	function index() {
		$this->Type->recursive = 0;
		$this->set('types', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Type.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('type', $this->Type->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Type->create();
			if ($this->Type->save($this->data)) {
				$this->Session->setFlash(__('The Type has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Type could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Type', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Type->save($this->data)) {
				$this->Session->setFlash(__('The Type has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Type could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Type->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Type', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Type->del($id)) {
			$this->Session->setFlash(__('Type deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>
