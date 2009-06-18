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
	function testlabsview($id = null) {
        $this->StdFuncs->view($id);
        
        $this->Project->Requirement->Behaviors->attach('Containable');
        $requirements = $this->Project->Requirement->find('all',array(
            'condtions'=>array(
                'project_id' => $id
            ),
            'contain'=> array(
                'Testcase'
            )
        ));

        $passed=0; $failed = 0; $notdone = 0;
        foreach($requirements as $requirement){
            foreach($requirement['Testcase'] as $testcase){
                $status = $this->Project->Testcase->getStatus($testcase['id'],$requirement['Requirement']['id']);
                switch ($status) {
                case 'passed':
                    $passed++;
                    break;
                case 'failed':
                    $failed++;
                    break;
                case 'notdone':
                    $notdone++;
                	break;
                }
            }
        }
        $this->set('passed',$passed);
        $this->set('failed',$failed);
        $this->set('notdone',$notdone);

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
        $this->layout = "green_select";
        $id = $this->data['Project']['project_id'];

        if($id){
            $project=$this->Project->find(array('Project.id' => $id));
            if(!empty($project)){
                $user=$this->Auth->user('id');
                if($this->MyAcl->hasAccess($user,'/'.$project['Project']['name'])){
        			if ($this->Session->write('project_id',$id) && $this->Session->write('project_name',$project['Project']['name']) && $this->Session->write('project_aco_id',$project['Myaco']['id'])) {
                        if($this->referer()=='/projects/select'){
                            $this->redirect(array('controller'=>'requirements', 'action'=>'index'));
                        }else{
                            $this->redirect($this->referer());
                        }
        			} else {
        				$this->Session->setFlash(__('The project session could not be set. Please, try again.', true));
        			}
                }else{
                    $this->Session->setFlash(__('You do not have access to this project.', true));
                }
            }else{
                $this->Session->setFlash(__('You do not have access to this project.', true)); //Unambigious error message for security
            }
		}
		
	    if(!empty($this->data)){
            $this->Session->setFlash(__('No project selected. Please, try again.', true));
        }
        $user=$this->Auth->user('id');
        $this->Project->recursive = 0;
        $projects=$this->Project->find('all');
        foreach($projects as $project){
            if($this->MyAcl->hasAccess($user,'/'.$project['Project']['name'])){
                $usersprojects[]=$project;
            }
        }
        if(!empty($usersprojects)){
            $this->set('usersprojects',$usersprojects);
        }else{
            $this->Session->setFlash(__('You do not have access to any projects.', true));
            $this->redirect(array('controller'=>'users', 'action'=>'login'));
        }

    }

}
?>
