<?php
class SitesController extends AppController {

	var $name = 'Sites';
	var $helpers = array('Html', 'Form');
	var $main_menu_id = -2;
	
	function select(){
        $this->Session->write('site_id',$this->data['Site']['site_id']);
        $this->redirect($this->referer());
    }
    
    function delete($site_id){
        $this->Site->del($site_id);
    }

	function add() {
	}


}
?>
