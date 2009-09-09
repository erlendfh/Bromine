<?php

    class ItemsController extends AppController {
        var $name = 'Items';
        var $uses = array('Item', 'Test', 'Suite', 'Browser', 'Operatingsystem', 'Testcase', 'Requirement');

        function index(){
            $items = $this->Item->find('all',array('conditions'=>array('user_id'=>$this->Auth->user('id'))));
            foreach($items as &$item){
                $item['Item']['sql'] = $this->Item->query($item['Item']['sql']);
            }
            $this->set('items', $items);

        }
        
        function edit($id){
            if(!empty($this->data)){
                App::import('Sanitize');
                $this->data = Sanitize::clean($this->data);
                $model = $this->data['Item']['Model'];              
                $testcases = $this->data['Item']['Testcase'];
                $requirements = $this->data['Item']['Requirement'];
                $statuses = $this->data['Item']['Status'];                                        
                $browsers = $this->data['Item']['Browser'];
                $operatingsystems = $this->data['Item']['Operatingsystem'];
                
                if($model=='Testcase'){
                    $query = "
                        SELECT * FROM testcases, tests, suites, projects, browsers, operatingsystems WHERE
                        testcases.id = tests.testcase_id AND
                        tests.suite_id = suites.id AND
                        testcases.project_id = projects.id AND
                        tests.browser_id = browsers.id AND
                        tests.operatingsystem_id = operatingsystems.id AND
                        projects.id = ".$this->Session->read('project_id');
                    
                    if($testcases[0] != 'All'){
                        $query .= " AND testcases.id IN ( ".implode(",", $testcases)." )";
                    }
                    if($requirements[0] != 'All'){
                        //$query .= " AND requirements.id IN ( ".implode(",", $requirements)." )";
                    }
                    if($browsers[0] != 'All'){
                        $query .= " AND browsers.id IN ( ".implode(",", $browsers)." )";
                    }
                    if($operatingsystems[0] != 'All'){
                        $query .= " AND operatingsystems.id IN ( ".implode(",", $operatingsystems)." )";
                    }
                    if($statuses[0] != 'All'){
                        foreach($statuses as &$status){
                           $status = "'$status'"; 
                        }
                        $query .= " AND tests.status IN ( ".implode(",", $statuses)." )";
                    }
                    $this->data['Item']['sql'] = $query;
                    if($this->Item->save($this->data)){
                        $this->Session->setFlash(__('The Item has been saved', true));
    				    $this->redirect(array('action'=>'index'));
				    }
                }
            }else{
                $models['Select'] = 'Select one';
                $models['Requirement'] = 'Requirement';
                $models['Testcase'] = 'Testcase';
                $this->set('models', $models);
                
                $this->data = $this->Item->read(null, $id);
                
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
            
        }
        
        function updateItemPosition($id, $left, $top){
            pr(array($id,$left,$top));
            $data['Item']['id'] = $id;
            $data['Item']['posx'] = $left;
            $data['Item']['posy'] = $top;
            $this->Item->save($data);
        }
        
        function updateItemSize($id, $height, $width){
            pr(array($id,$height,$width));
            $data['Item']['id'] = $id;
            $data['Item']['height'] = $height;
            $data['Item']['width'] = $width;
            $this->Item->save($data);
        }
    	
    }

?>
