<?php
class NodesController extends AppController {

	var $name = 'Nodes';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Node->recursive = 2;
		$this->set('nodes', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Node.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('node', $this->Node->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Node->create();
			if ($this->Node->save($this->data)) {
				$this->Session->setFlash(__('The Node has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Node could not be saved. Please, try again.', true));
			}
		}
		$browsers = $this->Node->Browser->find('list');
		$operatingsystems = $this->Node->Operatingsystem->find('list');
		$this->set(compact('browsers', 'operatingsystems'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Node', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Node->save($this->data)) {
				$this->Session->setFlash(__('The Node has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Node could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Node->read(null, $id);
		}
		$browsers = $this->Node->Browser->find('list');
		$operatingsystems = $this->Node->Operatingsystem->find('list');
		$this->set(compact('browsers','operatingsystems'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Node', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Node->del($id)) {
			$this->Session->setFlash(__('Node deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>
