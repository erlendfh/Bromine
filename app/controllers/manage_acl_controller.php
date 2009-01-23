<?php
class ManageAclController extends AppController {

	var $name = 'ManageAcl';
	var $helpers = array('Html', 'Form', 'Ajax', 'Javascript');
	var $layout = "admin";
	var $uses = array();
	var $components = array( 'RequestHandler' );
	
	function index(){
            $this->listAros();
            $this->listAcos();
    }
    
	function listAros($parent_id = null){
        App::import('Model','Myaro');
		$this->Myaro = new Myaro();
		$this->Myaro->recursive = 0;
		$this->set('CurrentAros', $this->Myaro->read(null,$parent_id));
		$this->set('Aros', $this->Myaro->find('all',array('conditions'=>array('parent_id'=>$parent_id),'order'=>'alias')));
	}

	function listAcos($parent_id = null){
		App::import('Model','Myaco');
		$this->Myaco = new Myaco();
		$this->Myaco->recursive = 0;
		$this->set('CurrentAcos', $this->Myaco->read(null,$parent_id));
        $this->set('Acos', $this->Myaco->find('all',array('conditions'=>array('parent_id'=>$parent_id),'order'=>'alias')));
	}

	function createAcl($aros,$acos){
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

	function removeAcl($id = null) {
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


}
?>
