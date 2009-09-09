<?php 
/* SVN FILE: $Id$ */
/* Node Fixture generated on: 2009-02-13 15:02:12 : 1234533732*/

class NodeFixture extends CakeTestFixture {
	var $name = 'Node';
	var $table = 'nodes';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'nodepath' => array('type'=>'string', 'null' => false, 'default' => NULL),
			'operatingsystem_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
			'description' => array('type'=>'text', 'null' => false, 'default' => NULL),
			'network_drive' => array('type'=>'string', 'null' => false, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $records = array(array(
			'id'  => 1,
			'nodepath'  => 'Lorem ipsum dolor sit amet',
			'operatingsystem_id'  => 1,
			'description'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'network_drive'  => 'Lorem ipsum dolor sit amet'
			));
}
?>