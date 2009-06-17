<?php
class SitesController extends AppController {

	var $name = 'Sites';
	var $helpers = array('Html', 'Form');
	
	function select(){
        $this->Session->write('site_id',$this->data['Site']['site_id']);
        $this->redirect($this->referer());
    }

	function index() {
		$this->Site->recursive = 0;
		$this->set('sites', $this->paginate(null, array('project.id' => $this->Session->read('project_id'))));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Site.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('site', $this->Site->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Site->create();
			if ($this->Site->save($this->data)) {
				$this->Session->setFlash(__('The Site has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Site could not be saved. Please, try again.', true));
			}
		}
		$projects = $this->Site->Project->find('list');
		$this->set(compact('projects'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Site', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Site->save($this->data)) {
				$this->Session->setFlash(__('The Site has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Site could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Site->read(null, $id);
		}
		$projects = $this->Site->Project->find('list');
		$this->set(compact('projects'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Site', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Site->del($id)) {
			$this->Session->setFlash(__('Site deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>
