<?php
class Myaco extends AppModel {

	var $name = 'Myaco';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasAndBelongsToMany = array(
			'Myaro' => array('className' => 'Myaro',
						'joinTable' => 'myaros_myacos',
						'foreignKey' => 'myaco_id',
						'associationForeignKey' => 'myaro_id',
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
