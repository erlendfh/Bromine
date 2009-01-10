<?php
class MyacosController extends AppController {

	var $name = 'Myacos';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Myaco->recursive = 0;
		$this->set('myacos', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Myaco.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('myaco', $this->Myaco->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Myaco->create();
			if ($this->Myaco->save($this->data)) {
				$this->Session->setFlash(__('The Myaco has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Myaco could not be saved. Please, try again.', true));
			}
		}
		$myaros = $this->Myaco->Myaro->find('list');
		$this->set(compact('myaros'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Myaco', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Myaco->save($this->data)) {
				$this->Session->setFlash(__('The Myaco has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Myaco could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Myaco->read(null, $id);
		}
		$myaros = $this->Myaco->Myaro->find('list');
		$this->set(compact('myaros'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Myaco', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Myaco->del($id)) {
			$this->Session->setFlash(__('Myaco deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>