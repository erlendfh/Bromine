<?php
class CommandsController extends AppController {

	var $name = 'Commands';
	var $helpers = array('Html', 'Form');

	function index() {
        //pr($this->belongsToProject($this->Command));
		$this->Command->recursive = 0;
		$this->set('commands', $this->paginate());
	}
	
	function belongsToProject($path){
	    $this->i++;
        if(array_key_exists('Project', $path->belongsTo)){
            $this->route[]=$path->belongsTo['Project'];
            return $this->route; 
        }
        elseif($this->i>15){
            return "Recursion!!";
        }else{
            foreach($path->belongsTo as $step){
                $this->route[]=$step;
                return $this->belongsToProject($path->$step['className']);
            }
        }
        //return false;
    }

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Command.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('command', $this->Command->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Command->create();
			pr($this->data);
			if ($this->Command->save($this->data)) {
				$this->Session->setFlash(__('The Command has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Command could not be saved. Please, try again.', true));
			}
		}
		$tests = $this->Command->Test->find('list');
		$this->set(compact('tests'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Command', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Command->save($this->data)) {
				$this->Session->setFlash(__('The Command has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Command could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Command->read(null, $id);
		}
		$tests = $this->Command->Test->find('list');
		$this->set(compact('tests'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Command', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Command->del($id)) {
			$this->Session->setFlash(__('Command deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>
