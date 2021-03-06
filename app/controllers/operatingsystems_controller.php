<?php
class OperatingsystemsController extends AppController {

	var $name = 'Operatingsystems';
	var $helpers = array('Html', 'Form');
	var $main_menu_id = -2;

	function index() {
		$this->Operatingsystem->recursive = 0;
		$this->set('operatingsystems', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Operatingsystem.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('operatingsystem', $this->Operatingsystem->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Operatingsystem->create();
			if ($this->Operatingsystem->save($this->data)) {
			
				$browser = new Browser();
			    $combination = new Combination();
			    
			    $browser->recursive = 0;
			    $all_browser = $browser->find('all');
			    		    
			    foreach ($all_browser as $value) {
			    
			        $data = array();
			        $data['Combination']['browser_id'] = $value['Browser']['id'];
			        $data['Combination']['operatingsystem_id'] = $this->Operatingsystem->id;
			        $combination->create();
			        $combination->save($data);
			        
                }
			
				$this->Session->setFlash(__('The Operatingsystem has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Operatingsystem could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Operatingsystem', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Operatingsystem->save($this->data)) {
				$this->Session->setFlash(__('The Operatingsystem has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Operatingsystem could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Operatingsystem->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Operatingsystem', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Operatingsystem->del($id)) {
		
                $combination = new Combination();
			    $all_com = $combination->find('all',
                    array('conditions' => array('Combination.operatingsystem_id'=>$id))
                );	    
                
			    foreach ($all_com as $key=>$value) {
			         $this->Operatingsystem->Combination->del($value['Combination']['id']);
                }
			$this->Session->setFlash(__('Operatingsystem deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>
