<?php
class Myaro extends AppModel {

	var $name = 'Myaro';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasAndBelongsToMany = array(
			'Myaco' => array('className' => 'Myaco',
						'joinTable' => 'myaros_myacos',
						'foreignKey' => 'myaro_id',
						'associationForeignKey' => 'myaco_id',
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