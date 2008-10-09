<?php
class Defect extends AppModel {

	var $name = 'Defect';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'User' => array('className' => 'User',
								'foreignKey' => 'user_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Project' => array('className' => 'Project',
								'foreignKey' => 'project_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Test' => array('className' => 'Test',
								'foreignKey' => 'test_id',
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

	var $hasAndBelongsToMany = array(
			'Attachment' => array('className' => 'Attachment',
						'joinTable' => 'attachments_defects',
						'foreignKey' => 'defect_id',
						'associationForeignKey' => 'attachment_id',
						'unique' => true,
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
			)
	);

}
?>