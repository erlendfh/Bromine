<?php
class Requirement extends AppModel {

	var $name = 'Requirement';
	var $validate = array(
		'name' => array('notempty'),
		'project_id' => array('numeric'),
		'nr' => array('notempty')
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

	var $hasAndBelongsToMany = array(
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