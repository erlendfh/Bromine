<?php 
/* SVN FILE: $Id$ */
/* Requirement Test cases generated on: 2009-06-12 13:06:04 : 1244806024*/
App::import('Model', 'Requirement');

class RequirementTestCase extends CakeTestCase {
	var $Requirement = null;
	var $fixtures = array('app.requirement', 'app.project', 'app.parent');

	function startTest() {
		$this->Requirement =& ClassRegistry::init('Requirement');
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
			'description'  => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida,phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam,vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit,feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'project_id'  => 1,
			'nr'  => 'Lore',
			'parent_id'  => 1
			));
		$this->assertEqual($results, $expected);
	}
}
?>