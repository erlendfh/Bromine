<?php
/* SVN FILE: $Id: app_controller.php 7296 2008-06-27 09:09:03Z gwoo $ */
/**
 * Short description for file.
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.cake.libs.controller
 * @since			CakePHP(tm) v 0.2.9
 * @version			$Revision: 7296 $
 * @modifiedby		$LastChangedBy: gwoo $
 * @lastmodified	$Date: 2008-06-27 05:09:03 -0400 (Fri, 27 Jun 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * This is a placeholder class.
 * Create the same file in app/app_controller.php
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		cake
 * @subpackage	cake.cake.libs.controller
 */
class AppController extends Controller {

    var $components = array('Auth', 'Acl', 'StdFuncs','Menu');
    
    function beforeFilter() {
        $this->Auth->fields  = array(
            'username'=>'name',
            'password' =>'password'
        );
        
        
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'projects', 'action' => 'select');
        
        $this->Auth->authorize = 'controller';
        
        $this->username = $this->Auth->user('name');
        $this->set('mainMenu',$this->Menu->createMenu(-1));
        $this->set('subMenu',$this->Menu->createMenu($this->Session->read('current_main_menu_id')));
        
        $this->set('adminMainMenu',$this->Menu->createMenu(-2));
        $this->set('adminSubMenu',$this->Menu->createMenu($this->Session->read('current_admin_main_menu_id')));

    }
    
    function isAuthorized(){
        if(isset($this->needsproject)){
            if((is_array($this->needsproject) && in_array($this->action, $this->needsproject)) || $this->needsproject===true){ //If the controller/action needs a project
                if(!empty($this->modelNames)){ //If it needs a project and has a model, set model to use before find/save stuff
                    $model = $this->modelNames[0];
                    $this->$model->needsproject = true;
                    $this->$model->project_id = $this->Session->read('project_id');
                }
                
                if($this->Session->check('project_id')){ //If project_id is set in the session
                    return true; //Maybe we should check here if the user has access to the project...
                }   
            }else{
                return true;
            }
        }else{ //If the controller don't need a project
            return true;
        }
        //If not returned yet, redirect to the select project screen:
        //$this->Session->setFlash('This location requires you have selected a project');
        $this->Session->setFlash('This location requires you have selected a project');
        $this->redirect(array('controller' => 'projects', 'action' => 'select'));
        return false;
    }
  

}
?>
