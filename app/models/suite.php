<?php
class Suite extends AppModel {

	var $name = 'Suite';
	var $pathToProjet = array(
        'Suite'=>'Project'
    );

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Project' => array('className' => 'Project',
								'foreignKey' => 'project_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Site' => array('className' => 'Site',
								'foreignKey' => 'site_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasMany = array(
			'Test' => array('className' => 'Test',
								'foreignKey' => 'suite_id',
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
