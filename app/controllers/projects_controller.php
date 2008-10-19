<?php
class ProjectsController extends AppController {

	var $name = 'Projects';
	var $helpers = array('Html', 'Form');
	
	function index(){
        $this->StdFuncs->index();
    }
    
    function view($id = null) {
        $this->StdFuncs->view($id);
	}
	
	function add() {
		$this->StdFuncs->add(array('User'));
	}
	
	function edit($id = null) {
		$this->StdFuncs->edit($id,array('User'));
	}

    function delete($id = null) {
		$this->StdFuncs->delete($id);
	}
}
?>
