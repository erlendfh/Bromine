<?php
class Type extends AppModel {

	var $name = 'Type';
	var $validate = array(
		'name' => array('notempty'),
		'command' => array('notempty'),
		'spacer' => array('notempty'),
		'extension' => array('notempty')
	);

}
?>