<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Html', 'Form');
	
	function assign(){ //Assigns users to projects using Myacl
        if (!empty($this->data)){ //If the user pressed submit
            $this->data['Myaco'] = array('id'=>$this->Session->read('project_aco_id')); //Set aco to current project
            App::import('Model','Myaco');
            $this->Myaco = new Myaco();
            if(!$this->Myaco->save($this->data)) { //Save the data
				$this->Session->setFlash(__('The Assignees could not be saved. Please, try again.', true));
			}
		}
        
        $this->paginate = $paginate = array(
            'order' => array(
                'Group.id' => 'asc'
            )
        );
        $this->layout = "default";
        $this->User->recursive = 0;
		$this->set('users', $this->paginate()); //Using the paginate to list users
		
		//Code below is for the checkboxes. There's probably a really clever and beatifull cake'ish way to do this. 
        $this->User->recursive = 0;
        $users = $this->User->find('all');
        $admin_users = array();
        $assigned_users = array();
        foreach($users as $user){ //Loop through all users and generate arrays with users who have accces and admin users 
            if($this->MyAcl->hasAccess($user['User']['id'],'/'.$this->Session->read('project_name'))){
                $assigned_users[] = $user['User']['id'];
            }
            if($this->MyAcl->hasAccess($user['User']['id'],'/everything')){
                $admin_users[] = $user['User']['id'];
            }
        }
        $this->set('assigned_users',$assigned_users); //Send the arrays to the viewer
        $this->set('admin_users',$admin_users);
    }
	
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
