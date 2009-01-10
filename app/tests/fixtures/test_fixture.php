<?php 
/* SVN FILE: $Id$ */
/* Test Fixture generated on: 2009-01-10 22:01:26 : 1231656626*/

class TestFixture extends CakeTestFixture {
	var $name = 'Test';
	var $table = 'tests';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
			'status' => array('type'=>'string', 'null' => true, 'default' => NULL),
			'name' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 45),
			'suite_id' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'length' => 10),
			'help' => array('type'=>'text', 'null' => false, 'default' => NULL),
			'manstatus' => array('type'=>'string', 'null' => false, 'default' => NULL),
			'author' => array('type'=>'integer', 'null' => true, 'default' => NULL),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
			);
	var $records = array(array(
			'id'  => 1,
			'status'  => 'Lorem ipsum dolor sit amet',
			'name'  => 'Lorem ipsum dolor sit amet',
			'suite_id'  => 1,
			'help'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,
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
			'manstatus'  => 'Lorem ipsum dolor sit amet',
			'author'  => 1
			));
}
?>