<?php include_once ('getprotect.php'); ?>
<?php
$test = $_GET['test'];
$type = $_GET['type'];
$sitetotest = $_GET['sitetotest'];
$b_id = $_GET['b_id'];
$n_id = $_GET['n_id'];
$datafile = $_GET['datafile'];
$p_id = $_GET['p_id'];
$p_name = $_GET['p_name'];
$user = $_GET['user'];
$pass = $_GET['pass'];
$tests = $_GET['tests'];
$suitename = $_GET['suitename'];
$lang = $_GET['lang'];
$time = time();
$dbh = new DBHandler();
$u_id = str_replace('.', '', microtime('U')) . rand(0, 1000);
$noderesult = $dbh->select('TRM_nodes', "WHERE ID=$n_id", "*");
while ($row = mysql_fetch_array($noderesult)) {
    $o_id = $row['o_id'];
    $network_drive = $row['network_drive'];
    $nodepath = $row['nodepath'];
}
$browsresult = $dbh->select('TRM_nodes_browsers', "WHERE b_id=$b_id AND n_id=$n_id", "*");
while ($row = mysql_fetch_array($browsresult)) {
    $browser = $row['browser_path'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <script type="text/javascript" src="js/prototype.js"></script>
  </head>
  <body>
    <?php
$url1 = "statusRC.php?time=$time&user=$user&pass=$pass&u_id=$u_id";
//$returnTo = "http://". $_SERVER['SERVER_NAME'];
$url = "RC/Drivers/$type/$test?sitetotest=$sitetotest&browser=$browser&p_id=$p_id&OS=$o_id&b_id=$b_id&o_id=$o_id&host=$nodepath&ss=\\\\$network_drive\\\\$type\\\\$p_name&u_id=$u_id&p_name=$p_name&type=$type&suitename=$suitename&lang=$lang";
if ($datafile == '') {
    foreach($tests as $value) {
        $url.= "&tests[]=$value";
    }
}
else{
    foreach($tests as $value) {
        $url.= "&tests[]=$value";
    }
    foreach($datafile as $value){
        $url.= "&datafile[]=$datafile";
    }
}
?>
    <div id='progress'></div>
    <div id='state'></div>
    
    <script type='text/javascript'>
      
      new PeriodicalExecuter(
        function(pe) {
          new Ajax.Updater('progress', '<?php echo $url1; ?>', { method: 'get' });
          if (document.getElementById('state').innerHTML!=''){
            pe.stop();
            new Ajax.Request('statusRC.php', {
              method: 'get',
              parameters: {del: '1', u_id: '<?php echo $u_id ?>', user: '<?php echo $user ?>', pass: '<?php echo $pass ?>', time: '<?php echo $time ?>'}
              }
            );
          }
        }
      , 1);
      
      new Ajax.Updater('state', '<?php echo $url; ?>', { method: 'get' });
    </script>
    
  </body>
</html>
