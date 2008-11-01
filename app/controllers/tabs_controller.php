<?php
class TabsController extends AppController {
    var $uses = null;
	var $name = 'Tabs';
	//var $helpers = array('Html', 'Form');
	
	function home() {
	   $this->Session->write('current_main_menu_id', 2);
	   $this->set('subMenu',$this->Menu->createMenu(2));
	}

	function menuprojects() {
	   $this->Session->write('current_main_menu_id', 1);
	   $this->set('subMenu',$this->Menu->createMenu(1));
	}
	
	function testplan() {
	   $this->Session->write('current_main_menu_id', 3);
	   $this->set('subMenu',$this->Menu->createMenu(3));
	}
	
	function testlab() {
	   $this->Session->write('current_main_menu_id', 4);
	   $this->set('subMenu',$this->Menu->createMenu(4));
	}
	
	function results() {
	   $this->Session->write('current_main_menu_id', 5);
	   $this->set('subMenu',$this->Menu->createMenu(5));
	}
	
	function config() {
	   $this->Session->write('current_main_menu_id', 6);
	   $this->set('subMenu',$this->Menu->createMenu(6));
	}

}
?>
