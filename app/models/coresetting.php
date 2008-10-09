<?php
class Coresetting extends AppModel {

	var $name = 'Coresetting';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Site' => array('className' => 'Site',
								'foreignKey' => 'site_id',
								'conditions' => '',
								'fields' => 'name',
								'order' => ''
			),
			'Project' => array('className' => 'Project',
								'foreignKey' => 'project_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>
