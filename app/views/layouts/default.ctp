<?php
/* SVN FILE: $Id: default.ctp 7690 2008-10-02 04:56:53Z nate $ */
/**
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
 * @subpackage		cake.cake.libs.view.templates.layouts
 * @since			CakePHP(tm) v 0.10.0.1076
 * @version			$Revision: 7690 $
 * @modifiedby		$LastChangedBy: nate $
 * @lastmodified	$Date: 2008-10-02 00:56:53 -0400 (Thu, 02 Oct 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $html->charset(); ?>
        <title>
            <?php //__('CakePHP: the rapid development php framework:'); ?>
            <?php echo $title_for_layout; ?>
        </title>
        <?php
    		echo $html->meta('icon');
    		echo $html->css('template_css');
    		echo $html->css('content');
    		echo $scripts_for_layout;
        ?>
    </head>
    <body>
        <div id="wrapper">
            <div id="under">
                <div id="inside">
                    <div id="top"> 
                        <div id="top_menu" style="margin-bottom:0px;">
                            <table cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        <div id="menucenter">
                                            <table cellpadding="0" cellspacing="0" style="margin:0 auto;">
                                                <tr>
                                                    <td class="menu_m">
                                                        <div id="topnavi">
                                                            <ul>
                                                                <?php foreach($mainMenu as $mainMenuItem): ?>
                                                                <li><a href='<?php echo $mainMenuItem['link'] ?>'><span><?php echo $mainMenuItem['title'] ?></span></a></li>    
                                                                <?php endforeach; ?>
                                                            </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <!--
                        <div id="header">
                        
                            <div class="h_img">
                                <div id="logo">
                                    <h1>Joomlademo.de</h1>
                                </div>
                            </div>
                            
                        </div>
                        -->
                        <div class="content"> 
                            <div id="leftcolumn">
                                <div class="module">
                                    <div>
                                        <div>
                                            <div>
                                                <h3>Sub Menu</h3>
                                                <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                                      
                                                            
                                                    <?php 
                                                        /*
                                                        $current_controller = $this->params['controller'];
                                                        foreach($menu as $crap){
                                                            if($crap['id']==$current_controller){
                                                                foreach($crap['children'] as $menuitem){
                                                                    echo "<tr align='left'><td>";
                                                                    $title = $menuitem['title'];
                                                                    $action = $menuitem['url']['action'];
                                                                    echo $html->link(__($title,true), array('action'=>$action),array('class'=>"mainlevel"));
                                                                    echo "</td></tr>";
                                                                }
                                                                break;
                                                            }
                                                        }
                                                        */
                                                    ?>
                                                        
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="module">
                                    <div>
                                        <div>
                                            <div>
                                                <h3>Noget</h3>
                                                <br />
                                                <br />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="module">
                                    <div>
                                        <div>
                                            <div>
                                                <h3>Noget andet</h3>
                                                <br />
                                                <br />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            <div id="maincolumn">
                            
                                <?php $session->flash('auth'); ?>
                                <?php $session->flash(); ?>
			                    <?php echo $content_for_layout; ?>
			                    
                            </div> 
                            <!--
                            <div id="rightcolumn">
                                <div class="module">
                                </div>
                            </div>
                            -->
                            <div class="clr">
                            </div>
                        </div> 
                    </div> 
                </div>
                
            </div> 
            
            <div id="footer">
                <?php echo $cakeDebug; ?>
                <div id="sgf">
                    <p class="copyright">
                    
                    <!--
                        http://www.joomlademo.de, Powered by 
                        <a href="http://joomla.org/" class="sgfooter" target="_blank">Joomla!</a>
                        and designed by SiteGround 
                        <a href="http://www.siteground.com/" target="_blank" class="sgfooter">web hosting</a>
                        -->
                    </p>
                </div>
            </div>  
        </div>
        </div> 
        </div>
        </div>
        <!--pre>
        <?php //print_r($mainMenu); ?>
        </pre-->
    </body>
</html>
