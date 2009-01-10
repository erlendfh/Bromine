<?php
class Browser extends AppModel {

	var $name = 'Browser';
	var $validate = array(
		'browsername' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Suite' => array('className' => 'Suite',
								'foreignKey' => 'browser_id',
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
			'Node' => array('className' => 'Node',
						'joinTable' => 'browsers_nodes',
						'foreignKey' => 'browser_id',
						'associationForeignKey' => 'node_id',
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