<?php 
/* SVN FILE: $Id$ */
/* Requirement Fixture generated on: 2009-06-12 13:06:03 : 1244806023*/

class RequirementFixture extends CakeTestFixture {
	var $name = 'Requirement';
	var $table = 'requirements';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'name' => array('type'=>'string', 'null' => false, 'default' => NULL),
			'description' => array('type'=>'text', 'null' => false, 'default' => NULL),
			'project_id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
			'nr' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 6),
			'parent_id' => array('type'=>'integer', 'null' => false, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'p_id' => array('column' => array('project_id', 'nr'), 'unique' => 1))
			);
	var $records = array(array(
			'id'  => 1,
			'name'  => 'Lorem ipsum dolor sit amet',
			'description'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'project_id'  => 1,
			'nr'  => 'Lore',
			'parent_id'  => 1
			));
}
?>