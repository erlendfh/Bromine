<?php
class BrowsersNode extends AppModel {

	var $name = 'BrowsersNode';
	var $validate = array(
		'browser_id' => array('numeric'),
		'node_id' => array('numeric'),
		'browser_path' => array('notempty')
	);

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