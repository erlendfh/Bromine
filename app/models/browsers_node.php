<?php
class BrowsersNode extends AppModel {

	var $name = 'BrowsersNode';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Browser' => array('className' => 'Browser',
								'foreignKey' => 'browser_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Node' => array('className' => 'Node',
								'foreignKey' => 'node_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>