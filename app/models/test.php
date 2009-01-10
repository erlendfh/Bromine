<?php
class Test extends AppModel {

	var $name = 'Test';
	var $validate = array(
		'manstatus' => array('notempty')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Suite' => array('className' => 'Suite',
								'foreignKey' => 'suite_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasOne = array(
			'Command' => array('className' => 'Command',
								'foreignKey' => 'test_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Seleniumservervar' => array('className' => 'Seleniumservervar',
								'foreignKey' => 'test_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasMany = array(
			'Command' => array('className' => 'Command',
								'foreignKey' => 'test_id',
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
			'Seleniumservervar' => array('className' => 'Seleniumservervar',
								'foreignKey' => 'test_id',
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