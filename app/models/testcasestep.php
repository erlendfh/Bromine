<?php
class Testcasestep extends AppModel {

	var $name = 'Testcasestep';
	var $validate = array(
		'orderby' => array('numeric'),
		'testcase_id' => array('numeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Testcase' => array('className' => 'Testcase',
								'foreignKey' => 'testcase_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>