<?php
class StdFuncsComponent{

    function startup(&$controller) {
        $this->controller = $controller;
        //N: Name with first letter capital, p: plural, n: lowercase name
        $this->Np = $controller->name;
        $this->N = substr($controller->name,0,strlen($controller->name)-1); //Removes plural s
        $this->n = strtolower($this->N);
        $this->np = strtolower($this->Np);
	}
    
	function index() {
        $controller = $this->controller;
        $N = $this->N;
        $np = $this->np;

		$controller->$N->recursive = 0;
		$controller->set("$np", $controller->paginate());
	}

	function view($id = null) {
        $controller = $this->controller;
        $N = $this->N;
        $n = $this->n;
	
        $controller->$N->recursive = 2;
		if (!$id) {
			$controller->Session->setFlash(__("Invalid $n.", true));
			$controller->redirect(array('action'=>'index'));
		}
		$controller->set("$n", $controller->$N->read(null, $id));
	}

	function add($lists=array()) {
        $controller = $this->controller;
        $N = $this->N;
        $n = $this->n;
	
		if (!empty($controller->data)) {
			$controller->$N->create();
			if ($controller->$N->save($controller->data)) {
				$controller->Session->setFlash(__("The $n has been saved", true));
				$controller->redirect(array('action'=>'index'));
			} else {
				$controller->Session->setFlash(__("The $n could not be saved. Please, try again.", true));
			}
		}
		foreach($lists as $N2){
            $n2=strtolower($N2);
            $n2p=$n2."s";
            
            $$n2p = $controller->$N->$N2->find('list');
            $controller->set(compact("$n2p"));
        }
	}

	function edit($id = null,$lists=array()) {
        $controller = $this->controller;
        $N = $this->N;
        $n = $this->n;
	
		if (!$id && empty($controller->data)) {
			$controller->Session->setFlash(__("Invalid $n", true));
			$controller->redirect(array('action'=>'index'));
		}
		if (!empty($controller->data)) {
			if ($controller->$N->save($controller->data)) {
				$controller->Session->setFlash(__("The $n has been saved", true));
				$controller->redirect(array('action'=>'index'));
			} else {
				$controller->Session->setFlash(__("The $n could not be saved. Please, try again.", true));
			}
		}
		if (empty($controller->data)) {
			$controller->data = $controller->$N->read(null, $id);
		}
		foreach($lists as $N2){
            $n2=strtolower($N2);
            $n2p=$n2."s";
            
            $$n2p = $controller->$N->$N2->find('list');
            $controller->set(compact("$n2p"));
        }
	}

	function delete($id = null) {
        $controller = $this->controller;
        $N = $this->N;
        $n = $this->n;
		if (!$id) {
			$controller->Session->setFlash(__("Invalid id for $n", true));
			$controller->redirect(array('action'=>'index'));
		}
		if ($controller->$N->del($id)) {
			$controller->Session->setFlash(__("$N deleted", true));
			$controller->redirect(array('action'=>'index'));
		}
	}

}
?>
