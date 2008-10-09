<?php
class TypeofdefectsController extends AppController {

	var $name = 'Typeofdefects';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Typeofdefect->recursive = 0;
		$this->set('typeofdefects', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Typeofdefect.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('typeofdefect', $this->Typeofdefect->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Typeofdefect->create();
			if ($this->Typeofdefect->save($this->data)) {
				$this->Session->setFlash(__('The Typeofdefect has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Typeofdefect could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Typeofdefect', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Typeofdefect->save($this->data)) {
				$this->Session->setFlash(__('The Typeofdefect has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Typeofdefect could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Typeofdefect->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Typeofdefect', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Typeofdefect->del($id)) {
			$this->Session->setFlash(__('Typeofdefect deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>