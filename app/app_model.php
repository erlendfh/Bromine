<?php
/* SVN FILE: $Id: app_model.php 7296 2008-06-27 09:09:03Z gwoo $ */
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @subpackage		cake.cake.libs.model
 * @since			CakePHP(tm) v 0.2.9
 * @version			$Revision: 7296 $
 * @modifiedby		$LastChangedBy: gwoo $
 * @lastmodified	$Date: 2008-06-27 05:09:03 -0400 (Fri, 27 Jun 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Application model for Cake.
 *
 * This is a placeholder class.
 * Create the same file in app/app_model.php
 * Add your application-wide methods to the class, your models will inherit them.
 *
 * @package		cake
 * @subpackage	cake.cake.libs.model
 */
class AppModel extends Model {
    var $time;
    var $actsAs = array('Containable');
    
    function tic(){
        $this->time = microtime(true);
    }
    
    function toc($msg=null){
        pr($msg.' '.(microtime(true) - $this->time));
    }

    function beforeFind2($queryData){
        
        if(isset($this->pathToProject)){ //This variable is set in the model
            /*var $pathToProjet = array(
                'Command'=>'Test',
                'Test'=>'Suite',
                'Suite'=>'Project',
            );*/
            foreach($this->pathToProject as $k=>$v){
                $queryData['conditions']["$v.id"] = "$k.".low($v)."_id";
            }
            //WHERE command.test_id = test.id and test.suite_id = suite.id and suite.project_id = project_id
            
            //$queryData['conditions']['project_id']=$this->project_id;
            pr($queryData);
            return $queryData;
        }
    }
    
    /*function beforeSave(){
        if(isset($this->needsproject) && $this->needsproject===true){ //This variable is set in the AppController
            $this->data[$this->name]['project_id']=$this->project_id;
            return true;            
        }
    }*/
    
}
?>
