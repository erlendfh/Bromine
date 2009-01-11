<?php
class Project extends AppModel {

	var $name = 'Project';
	
	function beforeFind2($queryData){
        $queryData['conditions']['Project.id']=$_SESSION['project_id']; //Un-cakeli
        //pr($queryData);
        return $queryData;
    }

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	var $hasMany = array(
			'Requirement' => array('className' => 'Requirement',
								'foreignKey' => 'project_id',
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
			'Suite' => array('className' => 'Suite',
								'foreignKey' => 'project_id',
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
			'Testcase' => array('className' => 'Testcase',
								'foreignKey' => 'project_id',
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

}
?>
