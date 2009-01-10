<?php
class Menu extends AppModel {

	var $name = 'Menu';
	var $validate = array(
		'p_id' => array('numeric'),
		'title' => array('notempty'),
		'controller' => array('notempty'),
		'action' => array('notempty'),
		'odr' => array('numeric')
	);

}
?>