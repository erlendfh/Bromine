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
    		echo $scripts_for_layout;
    		echo $javascript->link('prototype');
            echo $javascript->link('scriptaculous');
            echo $javascript->link('sortable_tree');
        ?>

    </head>
    <body>
  <div id="main">
    <div id="links_container">
      <div id="logo"><h1>Bromine 3</h1><img id='notification' src='/img/ajax-loader.gif' alt="" style='display: none;'/></div>
      <script type='text/javascript'>

    Ajax.Responders.register({
    	onCreate: function(request) {
    		if($('notification') && Ajax.activeRequestCount > 0){
        		    $('notification').title = request.url;
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
    </script>
      <div id="links">
        <?php
            if(isset($username)){
                echo "Welcome, $username";
            }
        ?>
      </div>
    </div>
    <div id="menu">
      <ul>
        <!-- **** INSERT NAVIGATION ITEMS HERE (use id="selected" to identify the page you're on **** -->
        <?php if(isset($mainMenu)): ?>
        <?php foreach($mainMenu as $mainMenuItem): ?>
        <li><?php echo $html->link($mainMenuItem['title'], array('controller' => $mainMenuItem['controller'],'action' => $mainMenuItem['action'])); ?></li>    
        <?php endforeach; ?>
        <?php endif ?>
      </ul>
    </div>
    <div id="content">
        <!-- SUBMENU -->        
      <!--div id="column1">
        <div class="sidebaritem">
          <h1>Submenu</h1>
          <div class="sbilinks">
            
            <ul>
                <?php if(isset($subMenu)): ?>
                <?php foreach($subMenu as $subMenuItem): ?>
                <li><?php echo $html->aclLink(__($subMenuItem['title'],true), array('controller'=>$subMenuItem['controller'],'action'=>$subMenuItem['action'])); ?></li>  
                <?php endforeach; ?>
                <?php endif ?>   
            </ul>
          </div>
        </div>
 
      </div-->
      <div id="column2">
        <?php $session->flash('auth'); ?>
        <?php $session->flash(); ?>
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
