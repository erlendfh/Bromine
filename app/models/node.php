<?php
class Node extends AppModel {

	var $name = 'Node';
	var $validate = array(
		'nodepath' => array('notempty'),
		'operating_system_id' => array('numeric'),
		'network_drive' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'OperatingSystem' => array('className' => 'OperatingSystem',
								'foreignKey' => 'operating_system_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasAndBelongsToMany = array(
			'Browser' => array('className' => 'Browser',
						'joinTable' => 'browsers_nodes',
						'foreignKey' => 'node_id',
						'associationForeignKey' => 'browser_id',
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