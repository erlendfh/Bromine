<?php
class Requirement extends AppModel {
    function getStatusRecursive($requirement_id){
		if(empty($results)){
            $results = array();
        }
		$this->Behaviors->attach('Containable');
		$requirement = $this->find('first', array(
            'conditions'=>array(
                'Requirement.id'=>$requirement_id
            )
        ));
        $children = $this->find('all', array(
            'conditions'=>array(
                'Requirement.parent_id'=>$requirement_id
            )
        ));
		
		if(!empty($children)){
            foreach($children as $child){
                $results[] = $this->getStatusRecursive($child['Requirement']['id']);
            }
        }
        foreach($requirement['Testcase'] as $testcase){
            if(($result = $this->Testcase->getStatus($testcase['id'], $requirement_id))!=null){
                $results[] = $result;
            }
        }
        return $results;
    }
    
    function getStatus($requirement_id){
        $results = $this->getStatusRecursive($requirement_id);
        $objTmp = (object) array('aFlat' => array());
        array_walk_recursive($results, create_function('&$v, $k, &$t', '$t->aFlat[] = $v;'), $objTmp); //Crazy stuff from php.net
        $results = $objTmp->aFlat;

        $status = 'passed';

        if(empty($results)){
            $status = '';
        }
        if(in_array('notdone',$results)){
            $status = 'notdone';
        }
        if(in_array('failed',$results)){
            $status = 'failed';
        }

        return $status;
    }
    
    /*function beforeDelete{
        
    }*/
    

	var $name = 'Requirement';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Project' => array('className' => 'Project',
								'foreignKey' => 'project_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasAndBelongsToMany = array(
			'Combination' => array('className' => 'Combination',
						'joinTable' => 'combinations_requirements',
						'foreignKey' => 'requirement_id',
						'associationForeignKey' => 'combination_id',
						'unique' => true,
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
			),
			'Testcase' => array('className' => 'Testcase',
						'joinTable' => 'requirements_testcases',
						'foreignKey' => 'requirement_id',
						'associationForeignKey' => 'testcase_id',
						'unique' => true,
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
			)
	);

}
?>
