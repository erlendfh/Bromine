<?php
class ProjectsController extends AppController {

	var $name = 'Projects';
	var $helpers = array('Html', 'Form');
	
	function index(){
        $this->StdFuncs->index();
    }
    
    function view($id = null) {
        $this->StdFuncs->view($id);
	}
	
	function add() {
		$this->StdFuncs->add(array('User'));
	}
	
	function edit($id = null) {
		$this->StdFuncs->edit($id,array('User'));
	}

    function delete($id = null) {
		$this->StdFuncs->delete($id);
	}
	
	function select(){
        $this->layout = 'select';
        $id = $this->data['Project']['project_id'];
        if($id){
            $project=$this->Project->find('all', array('conditions' => array('id' => $id)));
            if(!empty($project)){
                $user=$this->Auth->user();
                $user=$user['User']['id'];
                $projectusers=$project[0]['User'];
                foreach($projectusers as $projectuser){
                    $userlist[]=$projectuser['id'];
                }
    
                $hasAccess = in_array($user,$userlist,true);
    
                if($hasAccess){
        			if ($this->Session->write('project_id',$id)) {
        				$this->redirect(array('controller'=>'tabs', 'action'=>'home'));
        			} else {
        				$this->Session->setFlash(__('The project session could not be set. Please, try again.', true));
        			}
                }else{
                    $this->Session->setFlash(__('You do not have access to this project1.', true));
                }
            }else{
                $this->Session->setFlash(__('You do not have access to this project2.', true)); //Unambigious error message for protection
            }
		}
		
	    if(!empty($this->data)){
            $this->Session->setFlash(__('No project selected. Please, try again.', true));
        }
        $user=$this->Auth->user();
        $user=$user['User']['id'];
        $user=$this->Project->User->find('all', array('conditions' => array('user.id' => $user)));
        if(!empty($user[0]['Project'])){
            $this->data = $user[0]['Project'];
        }else{
            $this->Session->setFlash(__('You do not have access to any projects.', true));
            $this->redirect(array('controller'=>'users', 'action'=>'login'));
        } 
        
    }

}
?>
