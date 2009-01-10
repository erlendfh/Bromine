<?php 
/* SVN FILE: $Id$ */
/* Requirement Test cases generated on: 2009-01-10 22:01:37 : 1231656457*/
App::import('Model', 'Requirement');

class TestRequirement extends Requirement {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class RequirementTestCase extends CakeTestCase {
	var $Requirement = null;
	var $fixtures = array('app.requirement', 'app.project');

	function start() {
		parent::start();
		$this->Requirement = new TestRequirement();
	}

	function testRequirementInstance() {
		$this->assertTrue(is_a($this->Requirement, 'Requirement'));
	}

	function testRequirementFind() {
		$this->Requirement->recursive = -1;
		$results = $this->Requirement->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Requirement' => array(
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
		$this->assertEqual($results, $expected);
	}
}
?>