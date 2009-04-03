<?php
class Requirement extends AppModel {

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