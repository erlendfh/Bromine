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
    		echo $html->css('green/datepicker');
    		echo $scripts_for_layout;
    		echo $javascript->link('prototype');
    		echo $javascript->link('scriptaculous');
    		echo $javascript->link('popup');
    		echo $javascript->link('prettify/prettify');
            echo $javascript->link('sortable_tree');
            echo $javascript->link('urlparser');
            echo $javascript->link('resize');
            echo $javascript->link('lightwindow');
            echo $javascript->link('datepicker');
            
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
            if(!empty($usersprojects) && $main_menu_id != -2){
                echo $form->create('Project',array('action' => 'select'));
                foreach($usersprojects as $project){
                    $options[$project['Project']['id']] = $project['Project']['name']; 
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
            	$html->image("tango/32x32/actions/system-log-out.png"), 
            	array('controller' => 'users','action' => 'logout'), 
            	array('escape' => false,'style'=>'float: right;', 'alt' => 'Logout'),
            	"Are you sure you wan't logout?"
            );     
             
            echo $html->link( 
            	$html->image("tango/32x32/apps/help-browser.png"), 
            	array('controller' => 'pages','action' => 'help_splash'), 
            	array('escape' => false, 'class'=>'lightwindow', 'params' => 'lightwindow_type=page', 'style'=>'float: right;')
            );    
            
    
    ?>
    </div>
    <div id="content" style='clear: both;'>
        <div id="column1"></div>
        <div id="column2">
            <div id='messages'>
                <?php if($session->check('Message.err')): ?>
                    <div id='err' style='color: darkred;'>
                        <?php 
                        foreach($session->read('Message.err') as $error){
                            echo "Error: $error <br />";   
                        }
                        ?>
                    </div>
                <?php endif ?>
                <?php if($session->check('Message.warn')): ?>
                    <div id='warn' style='color: #CC9933;'>
                    <?php 
                        foreach($session->read('Message.warn') as $warning){
                            echo "Warning: $warning <br />";   
                        }
                        ?>
                    </div>
                <?php endif ?>
                <?php if($session->check('Message.succ')): ?>
                    <div id='succ'>
                    <?php 
                        foreach($session->read('Message.succ') as $success){
                            echo "$success <br />";   
                        }
                        ?>
                    </div>
                <?php endif ?>
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
