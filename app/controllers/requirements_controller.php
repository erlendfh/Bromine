<?php
class RequirementsController extends AppController {

	var $name = 'Requirements';
	var $helpers = array('Html', 'Form','Tree','Table');
    var $needsproject = true;
    var $paginate = array(
        'limit' => 25,
        'order' => array(
            'Requirement.priority' => 'asc',
            'Requirement.nr' => 'asc'
        )
    );

     function reorder($id=null,$parent_id=null){    
        echo "id: $id p_id: $parent_id";

        if(isset($id) && isset($parent_id)){
            $this->data['Requirement']['id'] = $id;
            $this->data['Requirement']['parent_id'] = $parent_id;
            $this->Requirement->save($this->data);
        }
    }
    
    function updatetc($case,$testcase_id=null,$requirement_id=null){    
        $testcase_id = end(explode('_', $testcase_id));
        $requirement_id = end(explode('_', $requirement_id));

        $data = $this->Requirement->read(null, $requirement_id);
        $savedata['Requirement']['id'] =  $requirement_id;
        foreach($data['Testcase'] as $testcase){
            $savedata['Testcase']['Testcase'][] = $testcase['id'];
        }
        
        foreach($data['Combination'] as $combination){
            $savedata['Combination']['Combination'][] = $combination['id'];
        }
        
        if($case == 'add'){
            $savedata['Testcase']['Testcase'][] = $testcase_id;
        }elseif($case == 'remove'){
            if(($key=array_search($testcase_id, $savedata['Testcase']['Testcase']))!==false){
                unset($savedata['Testcase']['Testcase'][$key]);
            }else{
                return false;
            }
        }
        $this->Requirement->save($savedata);
    }
    
    function updateCombination($browser_id, $os_id, $requirement_id){
        //$this->Requirement->Behaviors->attach('Containable');
        /*
        Array
        (
            [Requirement] => Array
                (
                    [id] => 328
                    [name] => trille
                    [description] => This is an example of a requirement. Write your description here!
        <-- Write a nr and a name to the left
        Choose browser and OS combination, priority and assignee to the right -->
                    [project_id] => 123
                    [nr] => 1
                    [priority] => Urgent
                )
        
            [Combination] => Array
                (
                    [Combination] => Array
                        (
                            [0] => $combination_id
                        )
        
                )
        
        )
        */
        $combination = $this->Requirement->Combination->find('first',array('conditions'=>array('browser_id'=>$browser_id, 'operatingsystem_id' => $os_id)));

        $combination_id = $combination['Combination']['id'];
        $requirement = $this->Requirement->read(null,$requirement_id);

        $savedata['Requirement']['id'] = $requirement_id;
        
        foreach($requirement['Combination'] as $combination){
            $savedata['Combination']['Combination'][] = $combination['id'];
        }

        foreach($requirement['Testcase'] as $testcase){
            $savedata['Testcase']['Testcase'][] = $testcase['id'];
        }
        
        if(($key=array_search($combination_id, $savedata['Combination']['Combination']))!==false){
            unset($savedata['Combination']['Combination'][$key]);
        }else{
            $savedata['Combination']['Combination'][] = $combination_id;
        }
        
        //pr($savedata);
        /*
        $combinations = $requirement['Combination'];
        foreach($combinations as $k=>$combination){
            if($os_id == $combination['Operatingsystem']['id'] && $browser_id == $combination['Browser']['id']){
                unset($requirement['Combination'][$k]);
            }
        }
        pr($requirement);
        */
        $this->Requirement->save($savedata);
        /*
        $data = $this->Requirement->read(null, $requirement_id);
        $savedata['Requirement']['id'] =  $requirement_id;
        foreach($data['Testcase'] as $testcase){
            $savedata['Testcase']['Testcase'][] = $testcase['id'];
        }
        
        if($case == 'add'){
            $savedata['Testcase']['Testcase'][] = $testcase_id;
        }elseif($case == 'remove'){
            if(($key=array_search($testcase_id, $savedata['Testcase']['Testcase']))!==false){
                unset($savedata['Testcase']['Testcase'][$key]);
            }else{
                return false;
            }
        }
        $this->Requirement->save($savedata);
        */
    }
    
	function index() {
	   
		$this->Requirement->recursive = 1;
		//pr($this->Requirement->find('threaded'));
		$this->set('data',$this->Requirement->find('threaded'));
		//$this->set('data',$this->Requirement->find('all',array('conditions' => array('Requirement.project_id' => $this->Session->read('project_id')))));
		//$this->set('requirements', $this->paginate(null, array('project.id' => $this->Session->read('project_id'))));
		
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Requirement.', true));
			$this->redirect(array('action'=>'index'));
		}
        //$this->Requirement->recursive = 2;
		//$requirements = $this->Requirement->find("Requirement.id=$id");
		$this->Requirement->Behaviors->attach('Containable');
		$requirements = $this->Requirement->find('first', array(
            'conditions'=>array(
                'Requirement.id'=>$id
            ),
        	'contain'=>array(
        		'Combination' => array(
        			'Browser',
        			'Operatingsystem'
        		)
        	)
        ));
		$this->set('requirement', $requirements);
		$this->set('combinations',$requirements['Combination']);
		$this->Requirement->Combination->Browser->recursive = -1;
		$this->Requirement->Combination->Operatingsystem->recursive = -1;
		$this->set('browsers',$this->Requirement->Combination->Browser->find('all'));
		$this->set('operatingsystems',$this->Requirement->Combination->Operatingsystem->find('all'));
	}
	
	

	function add() {
		if (!empty($this->data)) {
			$this->Requirement->create();
			if ($this->Requirement->save($this->data)) {
				$this->Session->setFlash(__('The Requirement has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Requirement could not be saved. Please, try again.', true));
			}
		}
		$testcases = $this->Requirement->Testcase->find('list');
		$this->set(compact('testcases'));
	}

	function edit($id = null) {
	   pr($this->data);
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Requirement', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Requirement->save($this->data)) {
				$this->Session->setFlash(__('The Requirement has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Requirement could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Requirement->read(null, $id);
		}
		$testcases = $this->Requirement->Testcase->find('list');
		$this->set(compact('testcases'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Requirement', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Requirement->del($id)) {
			$this->Session->setFlash(__('Requirement deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>
