<?php
class Testcase extends AppModel {

	var $name = 'Testcase';
	var $validate = array(
		'project_id' => array('numeric')
	);

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
			'Testcasestep' => array('className' => 'Testcasestep',
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