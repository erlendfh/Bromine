<?php
class Project extends AppModel {

	var $name = 'Project';
	var $validate = array(
		'outsidedefects' => array('numeric'),
		'viewdefectsurl' => array('notempty'),
		'adddefecturl' => array('notempty')
	);


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
			'Site' => array('className' => 'Site',
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
