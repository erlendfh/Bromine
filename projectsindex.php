<?php require 'protected.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  	<?php require 'header.php'; ?>
  	<link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
<?php 
    require 'menu.php';
    $submenu = new BromineSubmenu();
    $submenu->projects();
    $submenu->display();
?>
  </body>
</html>
