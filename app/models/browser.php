<?php
class Browser extends AppModel {

	var $name = 'Browser';
	var $validate = array(
		'name' => array('notempty'),
		'path' => array('notempty')
	);

}
?>