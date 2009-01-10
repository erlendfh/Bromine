<?php
class Test extends AppModel {

	var $name = 'Test';
	var $pathToProject = array(
        'Test'=>'Suite',
        'Suite'=>'Project'
    );
    var $recursive = 2;
    
	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Suite' => array('className' => 'Suite',
								'foreignKey' => 'suite_id',
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
			)
	);

}
?>
