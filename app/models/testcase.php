<?php
class Testcase extends AppModel {

    function getStatus($testcase_id, $requirement_id){
        //$status = Cache::read("getTestCaseStatus.$testcase_id.$requirement_id.".$_SESSION['site_id']);

        //if (empty($status)){ //Get new statuses
            //pr("getting new statuses");
    		$requirement = $this->Requirement->find('first', array(
                'conditions'=>array(
                    'Requirement.id'=>$requirement_id
                ),
            	'contain'=>array(
            	    'Testcase',
            		'Combination' => array(
            			'Browser',
            			'Operatingsystem'
            		)
            	)
            ));
            $results = array();
            if(empty($requirement['Combination'])){
                return null;
            }
            foreach ($requirement['Combination'] as $combination){
                $results[] = $this->Test->getStatus($testcase_id, $combination['Operatingsystem']['id'], $combination['Browser']['id']);
            }
    
            $status = 'passed';
            
            if(in_array('notdone',$results)){
                $status = 'notdone';
            }
            if(in_array('failed',$results)){
                $status = 'failed';
            }
            //Cache::write("getTestCaseStatus.$testcase_id.$requirement_id.".$_SESSION['site_id'], $status, 60); // 1 hr cache
        //} 
        
        
        return $status;
    }

	var $name = 'Testcase';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Project' => array('className' => 'Project',
								'foreignKey' => 'project_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasMany = array(
			'TestcaseStep' => array('className' => 'Testcasestep',
								'foreignKey' => 'testcase_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			),
			'Test' => array('className' => 'Test',
								'foreignKey' => 'testcase_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			)
	);

	var $hasAndBelongsToMany = array(
			'Requirement' => array('className' => 'Requirement',
						'joinTable' => 'requirements_testcases',
						'foreignKey' => 'testcase_id',
						'associationForeignKey' => 'requirement_id',
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
