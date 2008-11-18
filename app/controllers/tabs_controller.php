<?php
class TabsController extends AppController {
    var $uses = null;
	var $name = 'Tabs';
	var $needsproject = array('home','menuprojects','testplan','testlab','results');
	//var $helpers = array('Html', 'Form');
	
	function home() {
	   $this->Session->write('current_main_menu_id', 2);
	   $this->set('subMenu',$this->Menu->createMenu(2));
	}

	function menuprojects() {
	   $this->Session->write('current_main_menu_id', 36);
	   $this->set('subMenu',$this->Menu->createMenu(36));
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
	
	//Admin stuff
	function admin() {
	   $this->layout = "admin";
	}
	
	function adminprojects() {
	   $this->layout = "admin";
	   $this->Session->write('current_admin_main_menu_id', 1);
	   $this->set('adminSubMenu',$this->Menu->createMenu(1));
	}
	
	function config() {
	   $this->layout = "admin";
	   $this->Session->write('current_admin_main_menu_id', 6);
	   $this->set('adminSubMenu',$this->Menu->createMenu(6));
	}
	
	function menuusers() {
	   $this->layout = "admin";
	   $this->Session->write('current_admin_main_menu_id', 34);
	   $this->set('adminSubMenu',$this->Menu->createMenu(34));
	}

}
?>
