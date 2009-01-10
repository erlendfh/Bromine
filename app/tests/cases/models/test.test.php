<?php 
/* SVN FILE: $Id$ */
/* Test Test cases generated on: 2009-01-10 22:01:26 : 1231656626*/
App::import('Model', 'Test');

class TestTest extends Test {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class TestTestCase extends CakeTestCase {
	var $Test = null;
	var $fixtures = array('app.test', 'app.suite', 'app.command', 'app.seleniumservervar', 'app.command', 'app.seleniumservervar');

	function start() {
		parent::start();
		$this->Test = new TestTest();
	}

	function testTestInstance() {
		$this->assertTrue(is_a($this->Test, 'Test'));
	}

	function testTestFind() {
		$this->Test->recursive = -1;
		$results = $this->Test->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Test' => array(
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
		$this->assertEqual($results, $expected);
	}
}
?>