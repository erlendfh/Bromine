<?php include ('protected.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <script type="text/javascript" src="js/prototype.js"></script>
  </head>
  <body>
    <?php
      $result = $dbh->select('TRM_cronjobs',"WHERE runtime<NOW() AND run=0","*");
      while($row = mysql_fetch_array($result)){
        $id=$row['id'];
        $job=$row['job'];
        fopen($job,'r');
        echo "$job opened @ ".date('d-m-y h:i:s');
        $dbh->update('TRM_cronjobs','run=1',"id=$id");
      }
    ?>
    <div id='progress'></div>
    <div id='state'></div>
    
    <script type='text/javascript'>
      new PeriodicalExecuter(
        function(pe) {
          new Ajax.Updater('progress','/ajaxCron.php', { method:'get'});
        }
      , 1);
    </script>
    
  </body>
</html>
