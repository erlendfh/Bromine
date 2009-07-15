<?php
class SuitesController extends AppController {

	var $name = 'Suites';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Suite->recursive = 0;
		//$this->set('suites', $this->paginate());
		$this->set('suites', $this->paginate(null, array('Project.id' => $this->Session->read('project_id'))));
	}

	function view($id = null) {
	   $this->Suite->recursive = 2;
		if (!$id) {
			$this->Session->setFlash(__('Invalid Suite.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('Suite', $this->Suite->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Suite->create();
			if ($this->Suite->save($this->data)) {
				$this->Session->setFlash(__('The Suite has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Suite could not be saved. Please, try again.', true));
			}
		}
		$projects = $this->Suite->Project->find('list');
		$this->set(compact('projects'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Suite', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Suite->save($this->data)) {
				$this->Session->setFlash(__('The Suite has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Suite could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Suite->read(null, $id);
		}
		$projects = $this->Suite->Project->find('list');
		$this->set(compact('projects'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Suite', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Suite->del($id)) {
			$this->Session->setFlash(__('Suite deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>
