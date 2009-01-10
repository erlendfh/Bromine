<?php
class Command extends AppModel {

	var $name = 'Command';
    var $pathToProject = array(
        'Command'=>'Test',
        'Test'=>'Suite',
        'Suite'=>'Project',
    );
    
    //WHERE command.test_id = test.id and test.suite_id = suite.id and suite.project_id = project_id
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
