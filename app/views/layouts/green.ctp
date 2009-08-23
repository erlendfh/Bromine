<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $html->charset(); ?>
        <title>
            <?php echo $title_for_layout; ?>
        </title>
        <?php
    		echo $html->meta('icon');
    		echo $html->css('green/style');
            echo $html->css('green/color');
    		echo $html->css('green/content');
    		echo $html->css('green/prettify');
    		echo $html->css('green/menu');
    		echo $html->css('green/lightwindow');
    		//echo $html->css('green/datepicker');
    		echo $scripts_for_layout;
    		echo $javascript->link('prototype');
    		echo $javascript->link('scriptaculous');
    		echo $javascript->link('popup');
    		echo $javascript->link('prettify/prettify');
            echo $javascript->link('sortable_tree');
            echo $javascript->link('urlparser');
            echo $javascript->link('resize');
            echo $javascript->link('lightwindow');
            //echo $javascript->link('datepicker');
            
        ?>
        

    </head>
    <body>
  <div id="main">
    <div id="links_container">
      <div id="logo">
          <h1>Bromine 3</h1>
            <img id='notification' src='img/ajax-loader.gif' style="display: none;" />
      </div>
        <script type='text/javascript'>
        
        Ajax.Responders.register({
        	onCreate: function(request) {
        		if($('notification') && Ajax.activeRequestCount > 0){
            		    $('notification').title = request.url;
                        //console.log(request);
                        if(request.container.success == 'Main'){
                            changeUrl(request.url);
            		    }
            		    
            			Effect.Appear('notification',{duration: 0.25, queue: 'end'});
        			}
        	},
        	onComplete: function() {
        		if($('notification') && Ajax.activeRequestCount == 0){
                    $('notification').title = '';
        			Effect.Fade('notification',{duration: 0.25, queue: 'end'});
        		}
        	}
        });
        
        observeUrl(0);
        
        function observeUrl(location){
            if(location != window.location.toString() && Ajax.activeRequestCount == 0){
                var anchor = getAnchor();
                if(anchor!=false){
                    new Ajax.Updater('Main',anchor,{evalScripts: true});
                }
            }
            oldlocation = window.location.toString();
            window.setTimeout("observeUrl(oldlocation)",200);
        }
        
        </script>
      <div id="links">
        <?php
            if(!empty($userprojects) && $main_menu_id != -2){
                echo $form->create('Project',array('action' => 'select'));
                foreach($userprojects as $project){
                    $options[$project['id']] = $project['name']; 
                }
                echo $form->input('project_id',array('options' => $options, 'selected'=>$session->read('project_id'), 'onchange'=>'submit()'));
                echo $form->end();
            }
            if(!empty($sites)){
                echo $form->create('Site', array('action' => 'select'));
                echo $form->input('site_id',array('selected'=>$session->read('site_id'), 'onchange'=>'submit()'));
                echo $form->end();
            }

        ?>
        
      </div>
    </div>
    <div id="menu">
        <!-- **** INSERT NAVIGATION ITEMS HERE (use id="selected" to identify the page you're on **** -->
        
        <?php
            if(!empty($Menu)){
                echo $tree->menustart($Menu);
            } 
        ?>
    

    <?php
          
            echo $html->link( 
            	$html->image("tango/32x32/actions/system-log-out.png", array('title'=>'Log out')), 
            	array('controller' => 'users','action' => 'logout'), 
            	array('escape' => false,'style'=>'float: right;'),
            	"Are you sure you want to log out?"
            );
            if($main_menu_id == -1){
                echo $html->aclLink( 
                	$html->image("tango/32x32/categories/preferences-system.png", array('title'=>'Control panel')), 
                	array('controller' => 'projects','action' => 'index'), 
                	array('escape' => false,'style'=>'float: right;')
                );
            }elseif($main_menu_id == -2){
                echo $html->aclLink( 
                	$html->image("tango/32x32/places/user-desktop.png", array('title'=>'Workspace')), 
                	array('controller' => 'requirements'), 
                	array('escape' => false,'style'=>'float: right;')
                );
            }
            /*
            if(count(split('/', $this->here))>2){
                $url = $this->here;
            }else{
                $url = $this->here.'/'.$this->action;
            }
            $path = 'http://'.$_SERVER['HTTP_HOST'].':'.$_SERVER['SERVER_PORT'].$url."/user:".$session->read('Auth.User.name').'/password:'.$user_password;
            $path .= ($session->read('project_id') ? '/project:'.$session->read('project_id') : '');
            */    
            
        ?>
        
        <!--a style='float: right; cursor: pointer;' onclick="$('directlink').update('<?php //echo $path; ?>'+(getAnchor() ? '#'+getAnchor() : '')); Effect.toggle('directlink','blind');" >
        <?php 
            //echo $html->image("tango/32x32/places/start-here.png", array('title'=>'Direct link'));
        ?>
        </a-->
    </div>
    <!--div id='directlink' style='float: right; display: none; padding-right: 20px;'></div-->
    <div id="content" style='clear: both;'>
        <div id="column1"></div>
        <div id="column2">
            <div id='messages'>
                <?php $session->flash('auth'); ?>
                <?php $session->flash(); ?>
            </div>
            <?php echo $content_for_layout; ?>
       </div>
    </div>
    <div id="footer">
      Copyright &copy; 2007-2009 Bromine Team | <a href="http://bromine.seleniumhq.org">Bromine</a> | <a href="http://www.dcarter.co.uk">Design by dcarter</a> | <?php if (!isset($register)){echo $html->link("Please Register", array('controller' => 'configs','action' => 'register'), array('class' => 'redlink'));}else{echo $register;} ?> | <?php echo "Version: " . $version; ?>
    </div>
    <div id="debug">
    <?php echo $cakeDebug; ?>
    </div>
  </div>
</body>
</html>
