<?php
class EchelonsController extends AppController {

	var $name = 'Echelons';
	var $helpers = array('Html', 'Form' , 'Time');
	var $main_menu_id = -2;

	function index() {
		$this->Echelon->recursive = 0;
		$this->set('echelons', $this->paginate());
	}

}
?>