<?php

    class PersonalController extends DashboardAppController {
        var $name = 'Personal';
        
        function index(){
            $items = $this->Personal->find('all',array('conditions'=>array('user_id'=>$this->Auth->user('id'))));
            foreach($items as &$item){
                $item['Personal']['sql'] = $this->Personal->query($item['Personal']['sql']);
            }
            $this->set('items', $items);
            
                        
            
        }
    	
    }

?>
