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
			),
			'User' => array('className' => 'User',
								'foreignKey' => 'user_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasAndBelongsToMany = array(
			/*'BrowsersOperatingSystem' => array('className' => 'BrowsersOperatingSystem',
						'joinTable' => 'browsers_operating_systems_requirements',
						'foreignKey' => 'requirement_id',
						'associationForeignKey' => 'browsers_operating_system_id',
						'unique' => true,
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
			),*/
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
