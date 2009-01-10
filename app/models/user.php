<?php
class User extends AppModel {

	var $name = 'User';
	var $validate = array(
		'firstname' => array('notempty'),
		'lastname' => array('notempty'),
		'name' => array('notempty'),
		'password' => array('notempty'),
		'group_id' => array('numeric'),
		'email' => array('email'),
		'lastLogin' => array('date')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Group' => array('className' => 'Group',
								'foreignKey' => 'group_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>