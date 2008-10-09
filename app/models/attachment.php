<?php
class Attachment extends AppModel {

	var $name = 'Attachment';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasAndBelongsToMany = array(
			'Defect' => array('className' => 'Defect',
						'joinTable' => 'attachments_defects',
						'foreignKey' => 'attachment_id',
						'associationForeignKey' => 'defect_id',
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