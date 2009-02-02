<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <?php echo $html->charset(); ?>
        <title>
            <?php echo $title_for_layout; ?>
        </title>
        <?php
    		echo $html->meta('icon');
    		echo $html->css('104/color');
    		echo $html->css('104/style');
    		echo $html->css('104/content');
    		echo $scripts_for_layout;
        ?>
    </head>
    <body>
  <div id="main">
    <div id="links">
        <?php
            if(isset($username)){
                echo "Welcome, $username";
            }
        ?>
    </div>
    <div id="logo"><h1>Shaping the future</h1><h3>One idea at a time</h3></div>
    <div id="content">
      <div id="column1">
        <div id="menu">
          <h1>navigate_</h1>
          <ul>
            <?php if(isset($mainMenu)): ?>
            <?php foreach($mainMenu as $mainMenuItem): ?>
            <li><?php echo $html->link($mainMenuItem['text'], array('controller'=>$mainMenuItem['controller'], 'action'=>$mainMenuItem['action'])); ?></li>    
            <?php endforeach; ?>
            <?php endif ?>
          </ul>
        </div>
        <div class="sidebaritem">
          <h1>news_</h1>
          <!-- **** INSERT NEWS ITEMS HERE **** -->
          <h2>1st January 2006</h2>
          <p>The company announces the launch of it's new website.</p>
          <h2>1st January 2006</h2>
          <p>The company announces the launch of it's new website.</p>
          <p>NOTES: This area can be used for news or any other info.</p>
        </div>
        <div id="addlinks">
          <h1>links_</h1>
          <!-- **** INSERT ADDITIONAL LINKS HERE **** -->
          <ul>
            <li><a href="">another link</a></li>
            <li><a href="">another link</a></li>
            <li><a href="">another link</a></li>
            <li><a href="">another link</a></li>
          </ul>
        </div>
        <div class="sidebaritem">
          <h1>information_</h1>
          <!-- **** INSERT OTHER INFORMATION HERE **** -->
          <p>
            This space can be used for additional information such as a contact phone number, address
            or maybe even a graphic.
          </p>
        </div>
      </div>
      <div id="column2">
        <?php $session->flash('auth'); ?>
        <?php $session->flash(); ?>
        <?php echo $content_for_layout; ?>
      </div>
    </div>
    <div id="footer">
      &copy; 2006 your name | <a href="#">email@emailaddress</a> | <a href="http://validator.w3.org/check?uri=referer">XHTML 1.1</a> | <a href="http://jigsaw.w3.org/css-validator/check/referer">CSS</a> | <a href="http://www.dcarter.co.uk">design by dcarter</a>
    </div>
    <br /><br /><br /><br />
    <div id="debug">
    <?php echo $cakeDebug; ?>
    </div>
  </div>
</body>
</html>
