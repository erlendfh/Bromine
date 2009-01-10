<?php
class Suite extends AppModel {

	var $name = 'Suite';
	var $validate = array(
		'name' => array('notempty'),
		'site_id' => array('numeric'),
		'status' => array('notempty'),
		'project_id' => array('numeric'),
		'analysis' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Site' => array('className' => 'Site',
								'foreignKey' => 'site_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Browser' => array('className' => 'Browser',
								'foreignKey' => 'browser_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'OperatingSystem' => array('className' => 'OperatingSystem',
								'foreignKey' => 'operating_system_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Project' => array('className' => 'Project',
								'foreignKey' => 'project_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasMany = array(
			'Test' => array('className' => 'Test',
								'foreignKey' => 'suite_id',
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