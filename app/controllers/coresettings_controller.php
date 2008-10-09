<?php
class CoresettingsController extends AppController {

	var $name = 'Coresettings';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Coresetting->recursive = 0;
		$this->set('coresettings', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Coresetting.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('coresetting', $this->Coresetting->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Coresetting->create();
			if ($this->Coresetting->save($this->data)) {
				$this->Session->setFlash(__('The Coresetting has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Coresetting could not be saved. Please, try again.', true));
			}
		}
		$sites = $this->Coresetting->Site->find('list');
		$projects = $this->Coresetting->Project->find('list');
		$this->set(compact('sites', 'projects'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Coresetting', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Coresetting->save($this->data)) {
				$this->Session->setFlash(__('The Coresetting has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Coresetting could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Coresetting->read(null, $id);
		}
		$sites = $this->Coresetting->Site->find('list');
		$projects = $this->Coresetting->Project->find('list');
		$this->set(compact('sites','projects'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Coresetting', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Coresetting->del($id)) {
			$this->Session->setFlash(__('Coresetting deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>