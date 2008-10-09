<?php
class AttachmentsController extends AppController {

	var $name = 'Attachments';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Attachment->recursive = 0;
		$this->set('attachments', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Attachment.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('attachment', $this->Attachment->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Attachment->create();
			if ($this->Attachment->save($this->data)) {
				$this->Session->setFlash(__('The Attachment has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Attachment could not be saved. Please, try again.', true));
			}
		}
		$defects = $this->Attachment->Defect->find('list');
		$this->set(compact('defects'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Attachment', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Attachment->save($this->data)) {
				$this->Session->setFlash(__('The Attachment has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Attachment could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Attachment->read(null, $id);
		}
		$defects = $this->Attachment->Defect->find('list');
		$this->set(compact('defects'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Attachment', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Attachment->del($id)) {
			$this->Session->setFlash(__('Attachment deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>