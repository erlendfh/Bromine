<?php
class DefectsController extends AppController {

	var $name = 'Defects';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Defect->recursive = 0;
		$this->set('defects', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Defect.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('defect', $this->Defect->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Defect->create();
			if ($this->Defect->save($this->data)) {
				$this->Session->setFlash(__('The Defect has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Defect could not be saved. Please, try again.', true));
			}
		}
		$attachments = $this->Defect->Attachment->find('list');
		$users = $this->Defect->User->find('list');
		$projects = $this->Defect->Project->find('list');
		$tests = $this->Defect->Test->find('list');
		$sites = $this->Defect->Site->find('list');
		$this->set(compact('attachments', 'users', 'projects', 'tests', 'sites'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Defect', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Defect->save($this->data)) {
				$this->Session->setFlash(__('The Defect has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Defect could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Defect->read(null, $id);
		}
		$attachments = $this->Defect->Attachment->find('list');
		$users = $this->Defect->User->find('list');
		$projects = $this->Defect->Project->find('list');
		$tests = $this->Defect->Test->find('list');
		$sites = $this->Defect->Site->find('list');
		$this->set(compact('attachments','users','projects','tests','sites'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Defect', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Defect->del($id)) {
			$this->Session->setFlash(__('Defect deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>