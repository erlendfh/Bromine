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

    var $components = array('Auth', 'StdFuncs','MyAcl','RequestHandler','Menu');
    var $helpers = array('Html','Ajax','Javascript', 'Tree');
    var $layout = 'green';
    var $main_menu_id = -1;
    var $debugmode = true;
    var $echelon = false;
    var $time;
    
    function setFlash($msg,$key){
        $_SESSION['Message'][$key][]=$msg;
        return true;
    }
    
    function afterFilter(){
        $_SESSION['Message'] = '';
    }
    
    private function echelon($msg){
        $fp = fopen('logs/echelon.txt','a');
        fwrite($fp, date('l jS \of F Y h:i:s A'). ': ' . $msg."\n");
        fclose($fp);
    }
    
    function tic(){
        $this->time = microtime(true);
    }
    
    function toc($msg=null){
        pr($msg.' '.(microtime(true) - $this->time));
    }
    
    
    function beforeFilter() {

        if($this->echelon){
            $this->echelon($this->Auth->user('name').' requested '.print_r($this->params['url']['url'],true));
        }
        
        App::import('Model','Project');
        $this->Project = new Project();
        $user=$this->Auth->user('id');
        $this->Project->recursive = 0;
        $projects=$this->Project->find('all');
        
        foreach($projects as $project){
            if($this->MyAcl->hasAccess($user,'/'.$project['Project']['name'])){
                $usersprojects[]=$project;
            }
        }
        if(!empty($usersprojects)){
            $this->set('usersprojects',$usersprojects);
        }

        $this->Auth->fields  = array(
            'username'=>'name',
            'password' =>'password'
        );
        
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'projects', 'action' => 'select');
        
        $this->Auth->authorize = 'controller';
        
        $this->set('Menu',$this->Menu->createMenu($this->main_menu_id));

        if(isset($this->needsproject)){
            if((is_array($this->needsproject) && in_array($this->action, $this->needsproject)) || $this->needsproject===true){ //If the controller/action needs a project
                if($this->Session->check('project_id')===false){ //If project_id is NOT set in the session
                    $this->Session->setFlash('This location requires you have selected a project');
                    $this->redirect(array('controller' => 'projects', 'action' => 'select'));
                }
            }
        }

    }
    
    function isAuthorized(){
        //return true;
        return $this->MyAcl->hasAccess($this->Auth->user('id'),$this->here);
    }
    

}
?>
