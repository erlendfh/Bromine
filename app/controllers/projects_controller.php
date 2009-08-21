<?php
class ProjectsController extends AppController {

	var $name = 'Projects';
	var $helpers = array('Html', 'Form');
    var $main_menu_id = -2;

	function index() {
		$this->Project->recursive = 0;
		$this->set('projects', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Project.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Project->recursive = 1;
		$project = $this->Project->find('first', array(
			    'conditions'=>array(
                    'Project.id' => $id    
                ),
                'contain'=>array(
                    'User'=>array(
                        'Group'
                    ),
                    'Site'
                )
            ));
        $this->set('project', $project);
	}

	function add() {
		if (!empty($this->data)) {
			$this->Project->create();
			if ($this->Project->save($this->data)){
                if(!empty($this->data['Newsites'])){
                    foreach($this->data['Newsites'] as $newsite){
                        $this->Project->Site->create();
                        $this->Project->Site->save(array('Site'=>array('name'=>$newsite, 'project_id'=>$this->Project->id)));
                    }
                }
				$this->Session->setFlash(__('The Project has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Project could not be saved. Please, try again.', true));
			}
		}
		$users = $this->Project->User->find('list');
		$this->set(compact('users'));
	}
	
	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Project', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Project->save($this->data)){
			    if(!empty($this->data['Sites'])){
                    foreach($this->data['Sites'] as $id => $site){
                        $this->Project->Site->create();
                        $this->Project->Site->save(array('Site'=>array('id'=>$id, 'name'=>$site)));
                    }
                }
                if(!empty($this->data['Newsites'])){
                    foreach($this->data['Newsites'] as $newsite){
                        $this->Project->Site->create();
                        $this->Project->Site->save(array('Site'=>array('name'=>$newsite, 'project_id'=>$this->data['Project']['id'])));
                    }
                }
				$this->Session->setFlash(__('The Project has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Project could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
		    $this->Project->recursive = 1;
		    
			$this->data = $this->Project->find('first', array(
			    'conditions'=>array(
                    'Project.id' => $id    
                ),
                'contain'=>array(
                    'User'=>array(
                        'Group'
                    ),
                    'Site'
                )
            ));
		}
		$users = $this->Project->User->find('list');
		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Project', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Project->del($id)) {
			$this->Session->setFlash(__('Project deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}
	
	function testlabsview($id = null) {
	   $this->main_menu_id = -2;
	   if($id == null && $this->Session->check('project_id')){
	        $id = $this->Session->read('project_id');
       }
        $this->StdFuncs->view($id);
        
        $this->Project->Requirement->Behaviors->attach('Containable');
        $requirements = $this->Project->Requirement->find('all',array(
            'conditions'=>array(
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
	
	function select($project_id = null, $noredirect = false){
        $this->layout = "green_select";
        if(empty($project_id)){
            $project_id = $this->data['Project']['project_id'];
        }

        if($project_id){
            foreach($this->userprojects as $userproject){
                $userprojects_list[] = $userproject['id']; 
            }
            if(in_array($project_id, $userprojects_list)){
                $project = $this->Project->findById($project_id);
    			if ($this->Session->write('project_id',$project_id) && $this->Session->write('project_name',$project['Project']['name'])) {
                    if($noredirect === false){
                        if($this->referer()=='/projects/select'){
                            $this->redirect(array('controller'=>'requirements', 'action'=>'index'));
                        }else{
                            $this->redirect($this->referer());
                        }
                    }
    			}else {
    				$this->Session->setFlash(__('The project session could not be set. Please, try again.', true));
    			}
            }else{
                $this->Session->setFlash(__('You do not have access to this project.', true));
            }
		}
		
	    if(!empty($this->data)){
            $this->Session->setFlash(__('No project selected. Please, try again.', true));
        }
    }

}
?>