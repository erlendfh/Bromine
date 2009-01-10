<?php 
/* SVN FILE: $Id$ */
/* Myaro Test cases generated on: 2009-01-10 22:01:49 : 1231656349*/
App::import('Model', 'Myaro');

class TestMyaro extends Myaro {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class MyaroTestCase extends CakeTestCase {
	var $Myaro = null;
	var $fixtures = array('app.myaro');

	function start() {
		parent::start();
		$this->Myaro = new TestMyaro();
	}

	function testMyaroInstance() {
		$this->assertTrue(is_a($this->Myaro, 'Myaro'));
	}

	function testMyaroFind() {
		$this->Myaro->recursive = -1;
		$results = $this->Myaro->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Myaro' => array(
			'id'  => 1,
			'parent_id'  => 1,
			'alias'  => 'Lorem ipsum dolor sit amet'
			));
		$this->assertEqual($results, $expected);
	}
}
?>