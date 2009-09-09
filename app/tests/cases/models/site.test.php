<?php 
/* SVN FILE: $Id$ */
/* Site Test cases generated on: 2009-01-10 22:01:17 : 1231656497*/
App::import('Model', 'Site');

class TestSite extends Site {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class SiteTestCase extends CakeTestCase {
	var $Site = null;
	var $fixtures = array('app.site', 'app.project', 'app.suite');

	function start() {
		parent::start();
		$this->Site = new TestSite();
	}

	function testSiteInstance() {
		$this->assertTrue(is_a($this->Site, 'Site'));
	}

	function testSiteFind() {
		$this->Site->recursive = -1;
		$results = $this->Site->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Site' => array(
			'id'  => 1,
			'name'  => 'Lorem ipsum dolor sit amet',
			'project_id'  => 1
			));
		$this->assertEqual($results, $expected);
	}
}
?>