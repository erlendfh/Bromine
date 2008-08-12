<?php include_once ('protected.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  	<?php include ('header.php'); ?>
  	<link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
  <?php
$table = $_GET['table'];
$id = $_GET['id'];
?>
    <form action='saveComment.php' method='post'>
    <fieldset style='border: none;'>
      <input type='text' name='headline' size ='20' />
      <br />
      <textarea cols='20' rows='10' name='comment'></textarea>
      <br />
      <input type='hidden' value='<?php echo $table; ?>' name='table_name' />
      <input type='hidden' value='<?php echo $id; ?>' name='table_id' />
      <input type='submit' value='<?php echo $lh->getText('Save'); ?>'/>
    </fieldset>
    </form>
  </body>
</html>
