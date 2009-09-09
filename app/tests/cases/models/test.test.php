<?php 
/* SVN FILE: $Id$ */
/* Test Test cases generated on: 2009-06-09 12:06:21 : 1244544081*/
App::import('Model', 'Test');

class TestTestCase extends CakeTestCase {
	var $Test = null;
	var $fixtures = array('app.test', 'app.suite', 'app.browser', 'app.operatingsystem', 'app.command', 'app.seleniumserver');

	function startTest() {
		$this->Test =& ClassRegistry::init('Test');
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
			'help'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'manstatus'  => 'Lorem ipsum dolor sit amet',
			'author'  => 1,
			'browser_id'  => 1,
			'operatingsystem_id'  => 1
			));
		$this->assertEqual($results, $expected);
	}
}
?>