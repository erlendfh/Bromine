<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Html', 'Form', 'Time');
	var $main_menu_id = -2;
	
	function login() {
	    $this->layout = 'green_select';
        //Auth Magic
    }
     
    function logout() {
        $this->Session->destroy();
        $this->Session->setFlash('Good-Bye');
        $this->redirect($this->Auth->logout());
    }


	function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid User.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('user', $this->User->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The User has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
			}
		}
		$groups = $this->User->Group->find('list');
		$this->set(compact('groups'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid User', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
            if(!empty($this->data['User']['newpw1']) && !empty($this->data['User']['newpw2'])){
                if($this->data['User']['newpw1'] == $this->data['User']['newpw2']){
                    App::import('Security');
                    $this->data['User']['password'] = $this->Auth->password($this->data['User']['newpw1']); 
                }else{
                    $this->Session->setFlash('The new passwords provided did not match', true, array('class'=>'error'));
                    $this->redirect(array('action'=>'edit', $id));                    
                }
            }
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The User has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The User could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
			$groups = $this->User->Group->find('list');
		    $this->set(compact('groups'));
		    $projects = $this->User->Project->find('list');
            $this->set(compact('projects'));
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for User', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->User->del($id,true)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}
}
?>
