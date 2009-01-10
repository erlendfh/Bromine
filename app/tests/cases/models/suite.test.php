<?php 
/* SVN FILE: $Id$ */
/* Suite Test cases generated on: 2009-01-10 22:01:36 : 1231656516*/
App::import('Model', 'Suite');

class TestSuite extends Suite {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class SuiteTestCase extends CakeTestCase {
	var $Suite = null;
	var $fixtures = array('app.suite', 'app.site', 'app.browser', 'app.operating_system', 'app.project', 'app.test');

	function start() {
		parent::start();
		$this->Suite = new TestSuite();
	}

	function testSuiteInstance() {
		$this->assertTrue(is_a($this->Suite, 'Suite'));
	}

	function testSuiteFind() {
		$this->Suite->recursive = -1;
		$results = $this->Suite->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Suite' => array(
			'id'  => 1,
			'name'  => 'Lorem ipsum dolor sit amet',
			'site_id'  => 1,
			'status'  => 'Lorem ipsum dolor sit amet',
			'timedate'  => '2009-01-10 22:48:36',
			'timetaken'  => 1,
			'browser_id'  => 1,
			'operating_system_id'  => 1,
			'selenium_version'  => 'Lorem ipsum dolor sit amet',
			'selenium_revision'  => 'Lorem ipsum dolor sit amet',
			'project_id'  => 1,
			'analysis'  => 1
			));
		$this->assertEqual($results, $expected);
	}
}
?>