<?php
class Echelon extends AppModel {

	var $name = 'Echelon';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => 'Echelon.time DESC'
		)
	);

}
?>