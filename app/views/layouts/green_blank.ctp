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
    		echo $scripts_for_layout;
    		echo $javascript->link('prototype');
    		echo $javascript->link('popup');
    		echo $javascript->link('prettify/prettify');
            echo $javascript->link('scriptaculous');
            echo $javascript->link('sortable_tree');
        ?>

    </head>
    <body>
  <div id="main">
  <div id="links_container">
      <div id="logo"><h1>Bromine 3</h1><img id='notification' src='img/ajax-loader.gif' alt="" style='display: none;'/></div>
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
    <div id="content">
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
        Copyright &copy; 2007-2009 Bromine Team | <a href="http://bromine.seleniumhq.org">Bromine</a> | <a href="http://www.dcarter.co.uk">Design by dcarter</a>
    </div>
    <div id="debug">
    <?php echo $cakeDebug; ?>
    </div>
  </div>
</body>
</html>
