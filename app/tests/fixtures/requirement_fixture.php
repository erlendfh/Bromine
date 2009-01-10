<?php 
/* SVN FILE: $Id$ */
/* Requirement Fixture generated on: 2009-01-10 22:01:37 : 1231656457*/

class RequirementFixture extends CakeTestFixture {
	var $name = 'Requirement';
	var $table = 'requirements';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'name' => array('type'=>'string', 'null' => false, 'default' => NULL),
			'description' => array('type'=>'text', 'null' => false, 'default' => NULL),
			'project_id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
			'nr' => array('type'=>'string', 'null' => false, 'default' => NULL, 'length' => 6),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'p_id' => array('column' => array('project_id', 'nr'), 'unique' => 1))
			);
	var $records = array(array(
			'id'  => 1,
			'name'  => 'Lorem ipsum dolor sit amet',
			'description'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,
									phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,
									vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,
									feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.
									Orci aliquet, in lorem et velit maecenas luctus, wisi nulla at, mauris nam ut a, lorem et et elit eu.
									Sed dui facilisi, adipiscing mollis lacus congue integer, faucibus consectetuer eros amet sit sit,
									magna dolor posuere. Placeat et, ac occaecat rutrum ante ut fusce. Sit velit sit porttitor non enim purus,
									id semper consectetuer justo enim, nulla etiam quis justo condimentum vel, malesuada ligula arcu. Nisl neque,
									ligula cras suscipit nunc eget, et tellus in varius urna odio est. Fuga urna dis metus euismod laoreet orci,
									litora luctus suspendisse sed id luctus ut. Pede volutpat quam vitae, ut ornare wisi. Velit dis tincidunt,
									pede vel eleifend nec curabitur dui pellentesque, volutpat taciti aliquet vivamus viverra, eget tellus ut
									feugiat lacinia mauris sed, lacinia et felis.',
			'project_id'  => 1,
			'nr'  => 'Lore'
			));
}
?>