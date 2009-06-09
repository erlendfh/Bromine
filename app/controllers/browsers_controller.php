<?php
class BrowsersController extends AppController {

	var $name = 'Browsers';
	var $helpers = array('Html', 'Form');
	var $main_menu_id = -2;

	function index() {
		$this->Browser->recursive = 0;
		$this->set('browsers', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Browser.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('browser', $this->Browser->read(null, $id));
		pr($this->Browser->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Browser->create();
			if ($this->Browser->save($this->data)) {
				$this->Session->setFlash(__('The Browser has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Browser could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Browser', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Browser->save($this->data)) {
				$this->Session->setFlash(__('The Browser has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Browser could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Browser->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Browser', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Browser->del($id)) {
			$this->Session->setFlash(__('Browser deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>
