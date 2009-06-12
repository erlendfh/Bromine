<?php
class Operatingsystem extends AppModel {

	var $name = 'Operatingsystem';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Combination' => array('className' => 'Combination',
								'foreignKey' => 'operatingsystem_id',
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
			'Node' => array('className' => 'Node',
								'foreignKey' => 'operatingsystem_id',
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
			'Test' => array('className' => 'Test',
								'foreignKey' => 'operatingsystem_id',
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