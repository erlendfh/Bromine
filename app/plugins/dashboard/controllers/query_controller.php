<?php

    class QueryController extends DashboardAppController {
        var $uses = array('Command', 'Test', 'Suite', 'Browser', 'Operatingsystem', 'Testcase', 'Requirement');

        function index(){
            $models['Select'] = 'Select one';
            $models['Requirement'] = 'Requirement';
            $models['Testcase'] = 'Testcase';
            $this->set('models', $models);
            
            $testcases['All'] = 'All';
            array_push($testcases, $this->Testcase->find('list',array('conditions'=>array('project_id'=>$this->Session->read('project_id')))));
            $this->set('testcases', $testcases);
            
            $requirements['All'] = 'All';
            array_push($requirements, $this->Requirement->find('list',array('conditions'=>array('project_id'=>$this->Session->read('project_id')))));
            $this->set('requirements', $requirements);
            
            $browsers['All'] = 'All';
            array_push($browsers, $this->Browser->find('list'));
            $this->set('browsers', $browsers);
            
            
            $operatingsystems['All'] = 'All';
            array_push($operatingsystems, $this->Operatingsystem->find('list'));
            $this->set('operatingsystems', $operatingsystems);
            
            $statuses['All'] = 'All';
            $statuses['passed'] = 'Passed';
            $statuses['failed'] = 'Failed';
            $statuses['notdone'] = 'Not done';
            $this->set('statuses', $statuses);
        }
        
        function getData(){
            pr($this->data);
           
        }
            	
    }

?>
