<?php

class AclAcosController extends AclAppController {
	
	function load($id) {
		$this->layout = '';
		print_r(asd,asd,asd);
		$n = $this->AclAco->read(null, $id);
		$data = array(
			'id' => $n['AclAco']['id'],
			'alias' => $n['AclAco']['alias'],
			'model' => $n['AclAco']['model'],
			'key' => $n['AclAco']['foreign_key'],
			'parent_id' => $n['AclAco']['parent_id']
		);
		vendor('Acl.JSON');
		$json = new Services_JSON();
		$json = $json->encode($data);
		$this->set('json', $json);
	}
	
	function delete($id) {
		if (!$this->AclAco->del($id)) {
			$this->failure();
		}
		exit;
	}
	
	function children($id) {
		$this->layout = '';
		
		$node = $this->AclAco->read(null, $id);
		
		$children = $this->AclAco->children($id, true);
		
		$sorted = array();
		foreach ($children as $c) {
			$c['AclAco']['children'] = ($c['AclAco']['rght'] - $c['AclAco']['lft'] - 1) / 2;
			$sorted[$c['AclAco']['alias']] = $c;
		}
		ksort($sorted);
		
		$this->set('node', $node);
		$this->set('children', $sorted);
	}
		
	function add() {
		if (isset($this->data['AclAco']['parent_id']) &&  !$this->data['AclAco']['parent_id']) {
			$this->data['AclAco']['parent_id'] = null;
		}
		if (!$this->AclAco->save($this->data)) {
			$this->failure();
		}
		exit;
	}
	
	function update() {
		if (isset($this->data['AclAco']['parent_id']) &&  !$this->data['AclAco']['parent_id']) {
			$this->data['AclAco']['parent_id'] = null;
		}
		$this->layout = '';
		if (!$this->AclAco->save($this->data)) {
			$this->failure();
		}
		exit;
	}
	
}

?>
