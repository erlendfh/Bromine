<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml">    <head>        <?php echo $html->charset(); ?>        <title>            <?php echo $title_for_layout; ?>        </title>        <?php    		echo $html->meta('icon');    		echo $html->css('green/style');            echo $html->css('green/color');    		echo $html->css('green/content');    		echo $scripts_for_layout;    		echo $javascript->link('prototype');            echo $javascript->link('scriptaculous');        ?>    </head>    <body>  <div id="main">    <div id="links_container">      <div id="logo">        <h1>Bromine 3</h1>            </div>      <div id="links">        <?php            if(isset($username)){                echo "Welcome, $username";            }        ?>      </div>    </div>    <div id="menu">          </div>    <div id="content">      <div id="column1">      </div>      <div id="column2">        <?php $session->flash('auth'); ?>        <?php $session->flash(); ?>        <?php echo $content_for_layout; ?>      </div>    </div>    <div id="footer">        Copyright &copy; 2007-2009 Bromine Team | <a href="http://bromine.seleniumhq.org">Bromine</a> | <a href="http://www.dcarter.co.uk">Design by dcarter</a>    </div>    <div id="debug">    <?php echo $cakeDebug; ?>    </div>  </div></body></html>