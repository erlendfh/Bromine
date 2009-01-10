<?php
class MyarosController extends AppController {

	var $name = 'Myaros';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Myaro->recursive = 0;
		$this->set('myaros', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Myaro.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('myaro', $this->Myaro->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Myaro->create();
			if ($this->Myaro->save($this->data)) {
				$this->Session->setFlash(__('The Myaro has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Myaro could not be saved. Please, try again.', true));
			}
		}
		$myacos = $this->Myaro->Myaco->find('list');
		$this->set(compact('myacos'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Myaro', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Myaro->save($this->data)) {
				$this->Session->setFlash(__('The Myaro has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Myaro could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Myaro->read(null, $id);
		}
		$myacos = $this->Myaro->Myaco->find('list');
		$this->set(compact('myacos'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Myaro', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Myaro->del($id)) {
			$this->Session->setFlash(__('Myaro deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>