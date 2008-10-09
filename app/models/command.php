<?php
class Command extends AppModel {

	var $name = 'Command';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Test' => array('className' => 'Test',
								'foreignKey' => 'test_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>