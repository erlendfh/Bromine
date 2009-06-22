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
    		echo $scripts_for_layout;
    		echo $javascript->link('prototype');
    		echo $javascript->link('popup');
    		echo $javascript->link('prettify/prettify');
            echo $javascript->link('scriptaculous');
            echo $javascript->link('sortable_tree');
            echo $javascript->link('urlparser');
            //echo $javascript->link('jquery.address-1.0');
            
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
                    new Ajax.Updater('Main',anchor);
                }
            }
            oldlocation = window.location.toString();
            window.setTimeout("observeUrl(oldlocation)",200);
        }

        
        </script>
      <div id="links">
        <?php
            //pr($session->read('site_id'));
            if(!empty($usersprojects)){
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

    </div>
    <div id="content" style='clear: both;'>
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
      copyright &copy; 2006 your name | <a href="#">email@emailaddress</a> | <a href="http://validator.w3.org/check?uri=referer">XHTML 1.1</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> | <a href="http://www.dcarter.co.uk">design by dcarter</a>
    </div>
    <div id="debug">
    <?php echo $cakeDebug; ?>
    </div>
  </div>
    
    
    
</body>
</html>
