<?php
class Operatingsystem extends AppModel {

	var $name = 'Operatingsystem';
	var $validate = array(
		'name' => array('notempty')
	);

}
?>