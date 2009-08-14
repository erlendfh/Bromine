<?php
class SelftestController extends AppController {

	var $name = 'Selftest';
	var $helpers = array('Html', 'Form');
	var $uses = array();
	
	function build(){
        App::import('Core', 'File');
        $controllers = Configure::listObjects('controller');
        
        //Clean controllers
        $controllerWhiteList = array('App','Selftest','BuildAcl','Pages');
        foreach($controllerWhiteList as $controller){
            $index = array_search($controller, $controllers);
            if ($index !== false ) {
                unset($controllers[$index]);
            }
        }
        $baseMethods = get_class_methods('Controller');
 
        // look at each controller in app/controllers
        foreach ($controllers as &$controller) {
            App::import('Controller', $controller);
            $methods = get_class_methods($controller . 'Controller');
            
            //clean the methods. to remove those in Controller and private actions.
            foreach ($methods as $k => $method) {
                if (strpos($method, '_', 0) === 0) {
                    unset($methods[$k]);
                    continue;
                }
                if (in_array($method, $baseMethods)) {
                    unset($methods[$k]);
                    continue;
                }
            }
            
            $controllers2[$controller] = $methods;
            
        }
        //pr($controllers2);
        App::import('Model','Project');
        $this->Project = new Project();
        
        App::import('Model','Testcase');
        $this->Testcase = new Testcase();
        
        App::import('Model','Requirement');
        $this->Requirement = new Requirement();
        
        $this->log = array();
        
        $project = $this->Project->find('first',array('conditions'=>array('Project.name'=>'selftest')));
        if(empty($project)){ //create project
            $this->data['Project']['name'] = 'selftest';
            $this->Project->save($this->data);
            $project_id = $this->Project->id;
            $this->log[] = "Created project 'selftest'";
        }else{
            $project_id = $project['Project']['id'];
        }
        
        $requirement = $this->Requirement->find('first',array('conditions'=>array('Requirement.name'=>'selftest', 'Requirement.project_id'=>$project_id)));
        if(empty($requirement)){ //create project
            $this->data['Requirement']['name'] = 'selftest';
            $this->data['Requirement']['project_id'] = $project_id;
            $this->Requirement->save($this->data);
            $requirement_id = $this->Requirement->id;
            $this->log[] = "Created requirement 'selftest'";
        }else{
            $requirement_id = $requirement['Requirement']['id'];
        }
        
        foreach($controllers2 as $controller => $methods){ 
            foreach($methods as $method){//create testcases
                $testcase = $this->Testcase->find('first',array('conditions'=>array('Testcase.name'=>"$controller: $method")));
                if(empty($testcase)){
                    $this->data['Testcase']['name'] = "$controller: $method";
                    $this->data['Testcase']['project_id'] = $project_id;
                    $this->data['Requirement']['Requirement'][] = $requirement_id;
                    $this->Testcase->create();
                    $this->Testcase->save($this->data);
                    $this->log[] = "Created testcase '$controller: $method'";
                }
            }
        }
        pr($this->log);
    }

}
?>
