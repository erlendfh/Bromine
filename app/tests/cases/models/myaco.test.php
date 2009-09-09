<?php 
/* SVN FILE: $Id$ */
/* Myaco Test cases generated on: 2009-01-10 22:01:30 : 1231656330*/
App::import('Model', 'Myaco');

class TestMyaco extends Myaco {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class MyacoTestCase extends CakeTestCase {
	var $Myaco = null;
	var $fixtures = array('app.myaco');

	function start() {
		parent::start();
		$this->Myaco = new TestMyaco();
	}

	function testMyacoInstance() {
		$this->assertTrue(is_a($this->Myaco, 'Myaco'));
	}

	function testMyacoFind() {
		$this->Myaco->recursive = -1;
		$results = $this->Myaco->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Myaco' => array(
			'id'  => 1,
			'parent_id'  => 1,
			'alias'  => 'Lorem ipsum dolor sit amet'
			));
		$this->assertEqual($results, $expected);
	}
}
?>