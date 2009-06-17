<?php
class TestlabsController extends AppController {

	var $name = 'Testlabs';
	var $helpers = array('Html', 'Form','Tree');
    var $needsproject = true;
    var $uses = array();

    private function array_search_recursive($needle, &$haystack){
        foreach($haystack as $key => &$val){
            if($key === $needle){
                foreach($val as &$children){
                    $children['Requirement']['status'] = $this->Requirement->getStatus($children['Requirement']['id']);
                    foreach($children['Testcase'] as &$testcase){
                        $testcase['status'] = $this->Requirement->Testcase->getStatus($testcase['id'],$children['Requirement']['id']);
                    }
                }
                
            }
            if(is_array($val)){
                $this->array_search_recursive($needle, $val);
            }
        }
    }
  
    
	function index() {
        App::import('Model','Requirement');
        $this->Requirement = new Requirement();
		$this->Requirement->recursive = 1;
        
        $sites=$this->Project->Site->find('list', array('conditions' => array('project_id'=>$this->Session->read('project_id'))));
        $this->set('sites',$sites);

        if(!$this->Session->check('site_id')){
            $this->Session->write('site_id',key($sites));
        }
		
        $requirements = $this->Requirement->find('threaded', array('conditions' => array('Project.id'=>$this->Session->read('project_id'))));
        
        foreach($requirements as &$requirement){
            $requirement['Requirement']['status'] = $this->Requirement->getStatus($requirement['Requirement']['id']);
            foreach($requirement['Testcase'] as &$testcase){
                $testcase['status'] = $this->Requirement->Testcase->getStatus($testcase['id'],$requirement['Requirement']['id']);
            }
        }
        $this->array_search_recursive('children',$requirements);
        
        $this->set('data',$requirements);
        
        
	}


}
?>
