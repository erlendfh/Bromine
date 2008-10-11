<?php

class AclArosController extends AclAppController {
	
	function load($id) {
		$this->layout = '';
		$n = $this->AclAro->read(null, $id);
		
		$data = array(
			'id' => $n['AclAro']['id'],
			'alias' => $n['AclAro']['alias'],
			'model' => $n['AclAro']['model'],
			'key' => $n['AclAro']['foreign_key'],
			'parent_id' => $n['AclAro']['parent_id']
		);
		vendor('Acl.JSON');
		$json = new Services_JSON();
		$json = $json->encode($data);
		$this->set('json', $json);
	}
	
	function delete($id) {
		if (!$this->AclAro->del($id)) {
			$this->failure();
		}
		exit;
	}
		
	function children($id = null) {
		$this->layout = '';
		
		$node = $this->AclAro->read(null, $id);
		
		$children = $this->AclAro->children($id, true);
	
		$sorted = array();
		foreach ($children as $c) {
			$c['AclAro']['children'] = ($c['AclAro']['rght'] - $c['AclAro']['lft'] - 1) / 2;
			$sorted[$c['AclAro']['alias']] = $c;
		}
		ksort($sorted);
		
		$this->set('node', $node);
		$this->set('children', $sorted);
	}
		
	function add() {
		if (isset($this->data['AclAro']['parent_id']) &&  !$this->data['AclAro']['parent_id']) {
			$this->data['AclAro']['parent_id'] = null;
		}
		if (!$this->AclAro->save($this->data)) {
			$this->failure();
		}
		exit;
	}
	
	function update() {
		if (isset($this->data['AclAro']['parent_id']) &&  !$this->data['AclAro']['parent_id']) {
			$this->data['AclAro']['parent_id'] = null;
		}
		if (!$this->AclAro->save($this->data)) {
			$this->failure();
		}
		exit;
	}
	
	function test() {
		$array['AclAro'] = array(
			'parent_id' => '',
			'alias' => 'test'
		);
		$this->AclAro->save($array);
		exit;
	}
	
}

?>
