<?php

class AclAro extends AclAppModel {
	var $useTable = 'aros';
	var $actsAs = array('Tree');
	
	function getStringPath($id) {
		$pieces = $this->getPath($id);
		$path = array();
		foreach ($pieces as $p) {
			$path[] = $p['AclAro']['alias'];
		}
		$path = implode(' > ', $path);
		return $path;
	}	

}

?>
