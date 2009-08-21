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

    var $components = array('Auth', 'StdFuncs','RequestHandler','Menu', 'MyAcl');
    var $helpers = array('Html','Ajax','Javascript', 'Tree');
    var $layout = 'green';
    var $main_menu_id = -1;
    var $debugmode = true;
    var $echelon = true;
    var $time;
    var $version = '3.0';
    var $user_projects;
    
    private function echelon($url){
        /*
        $fp = fopen('logs/echelon.txt','a');
        fwrite($fp, date('l jS \of F Y h:i:s A'). ': ' . $msg."\n");
        fclose($fp);
        */
        $user = "";
        if ($this->Auth->user('id')){
            $user = $this->Auth->user('id');
        }
        App::import('Model','Echelon');
        $echelon = new Echelon();
        $echelon->create();
        $data['Echelon']['url'] = $url;
        $data['Echelon']['user_id'] = $user;
        $data['Echelon']['time'] = time();
        $data['Echelon']['ip'] = $_SERVER["REMOTE_ADDR"];
        
        $echelon->save($data);
        
        
        
        
    }
    
    private function tic(){
        $this->time = microtime(true);
    }
    
    private function toc($msg=null){
        pr($msg.' '.(microtime(true) - $this->time));
    }
    
    
    function beforeFilter() {
        if($this->echelon){
            $this->echelon(print_r($this->params['url']['url'],true));
            
        }
        //Auth stuff
        $this->Auth->fields  = array(
            'username'=>'name',
            'password' =>'password'
        );
        
        //Remote login    
        if(!empty($this->passedArgs['user']) && !empty($this->passedArgs['password'])){
            $data['User']['name'] = $this->passedArgs['user'];
            $data['User']['password'] = $this->passedArgs['password'];
            $this->Auth->login($data);
            if(!empty($this->passedArgs['project'])){
                $this->requestAction('/projects/select/'.$this->passedArgs['project'].'/true');                
            }
            
        }
        
        $this->Auth->loginAction = array('controller' => 'users', 'action' => 'login');
        $this->Auth->logoutRedirect = array('controller' => 'users', 'action' => 'login');
        $this->Auth->loginRedirect = array('controller' => 'projects', 'action' => 'select');
        $this->Auth->authorize = 'controller';
        
        //Set userprojects
        App::import('Model','User');
        $this->User = new User();
        $this->User->recursive = 1;
        $user = $this->User->findById($this->Auth->user('id'));
        $this->set('user_password', $user['User']['password']);
        $this->userprojects = $user['Project']; 
        if(!empty($this->userprojects)){
            $this->set('userprojects',$this->userprojects);
        }
        /*
        if(isset($this->needsproject)){
            if((is_array($this->needsproject) && in_array($this->action, $this->needsproject)) || $this->needsproject===true){ //If the controller/action needs a project
                if($this->Session->check('project_id')===false){ //If project_id is NOT set in the session
                    $this->Session->setFlash('This location requires you have selected a project');
                    $this->redirect(array('controller' => 'projects', 'action' => 'select'));
                }
            }
        }
        */
        

    }
    
    function beforeRender(){
        $this->set('main_menu_id', $this->main_menu_id);
        $this->set('Menu',$this->Menu->createMenu($this->main_menu_id));
        
        // Check if bromine is registred
        App::import('Model','Config');
        $config = new Config();
        $reg = $config->findByName('registered');
        if ($reg['Config']['value'] == 1){
            $this->set('register','Registered version');
        }
        
        // Set version for the viewer
        $this->set('version',$this->version);
    }
    
    function isAuthorized(){
        return true;
        //return $this->MyAcl->hasAccess($this->Auth->user('id'),$this->here);
    }
    

}
?>
