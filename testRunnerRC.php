<?php include_once ('getprotect.php'); ?>
<?php
$test = $_GET['test'];
$type = $_GET['type'];
$sitetotest = $_GET['sitetotest'];
$b_id = $_GET['b_id'];
$n_id = $_GET['n_id'];
$r_id = $_GET['r_id'];
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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
      <script type="text/javascript" src="js/prototype.js"></script>
    </head>
    <body>
<?php
if($r_id==''){
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
  
      <?php
  $url1 = "statusRC.php?time=$time&user=$user&pass=$pass&u_id=$u_id";
  //$returnTo = "http://". $_SERVER['SERVER_NAME'];
  $url = "RC/Drivers/$type/$test?sitetotest=$sitetotest&browser=$browser&p_id=$p_id&OS=$o_id&b_id=$b_id&o_id=$o_id&host=$nodepath&ss=\\\\$network_drive\\\\$type\\\\$p_name&u_id=$u_id&p_name=$p_name&type=$type&suitename=$suitename&lang=$lang";
  if($datafile != ''){
      $tests = array_unique($tests);
      foreach($tests as $value) {
          $url.= "&tests[]=$value";
      }
      foreach($datafile as $value){
          $url.= "&datafile[]=$value";
      }
  }
  else {
      foreach($tests as $value) {
          $url.= "&tests[]=$value";
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
  <?php
}else{
    $noderesult = $dbh->select('TRM_nodes', "", "*");
    while ($row = mysql_fetch_array($noderesult)) {
        $nodeid = $row['ID'];
        $nodepath = $row['nodepath'];
        $node_o_id = $row['o_id'];
        $msg = BromineUtilities::checkJavaServer($nodepath);
        echo "$nodepath";
        if($msg!='Online'){
          echo " not online!<br>";
          $offlineServers[] = $node_o_id;
        }
        else{
           $onlineServers[] = $node_o_id;
          echo " online!<br>";
        }

    }

  $result = $dbh->select('TRM_reqsosbrows, TRM_nodes, TRM_nodes_browsers, TRM_reqstests, TRM_requirements', "
  WHERE 
  TRM_reqsosbrows.r_id = $r_id AND
  TRM_reqsosbrows.o_id = TRM_nodes.o_id AND
  TRM_reqsosbrows.b_id = TRM_nodes_browsers.b_id AND
  TRM_nodes.ID = TRM_nodes_browsers.n_id AND
  TRM_reqstests.r_id = $r_id AND
  TRM_requirements.id = $r_id 
  GROUP BY TRM_nodes.o_id,TRM_nodes_browsers.b_id,t_name
  ", "TRM_nodes_browsers.n_id,TRM_nodes.o_id,TRM_nodes_browsers.b_id,network_drive,TRM_nodes.description as description,nodepath,t_name, TRM_requirements.name as r_name, TRM_nodes_browsers.browser_path as browser");
  //echo $dbh->getQuery();
  
  while ($row = mysql_fetch_array($result)) {

      $o_id = $row['o_id'];
      if (array_search($o_id, $onlineServers) !== false){  
          $u_id = str_replace('.', '', microtime('U')) . rand(0, 1000);
          $b_id = $row['b_id'];
          $n_id = $row['n_id'];
          $t_name = $row['t_name'];
          $browser = $row['browser'];
          $description = $row['description'];
          $suitename = "Requirement: ".$row['r_name']. " Test: $t_name";
          $nodepath = $row['nodepath'];
          $network_drive = $row['network_drive'];
          $browsername = $row['browsername'];
          $url = "http://localhost/Bromine/RC/Drivers/$type/$test?sitetotest=$sitetotest&browser=$browser&p_id=$p_id&OS=$o_id&b_id=$b_id&o_id=$o_id&host=$nodepath&ss=\\\\$network_drive\\\\$type\\\\$p_name&u_id=$u_id&p_name=$p_name&type=$type&suitename=$suitename&tests[]=$t_name&".'lang=en';
          echo "Did run:<br />";
          echo $t_name ." @ '$description' in '$browser'";
          echo "<br />";
          
          echo "<script type='text/javascript'>";
          echo "new Ajax.Request('$url')";
          echo "</script>";  
      }
      else{
          $u_id = str_replace('.', '', microtime('U')) . rand(0, 1000);
          $b_id = $row['b_id'];
          $n_id = $row['n_id'];
          $t_name = $row['t_name'];
          $browser = $row['browser'];
          $suitename = "Requirement: ".$row['r_name']. " Test: $t_name";
          $nodepath = $row['nodepath'];
          $description = $row['description'];
          $network_drive = $row['network_drive'];
          $browsername = $row['browsername'];
          $url = "http://localhost/Bromine/RC/Drivers/$type/$test?sitetotest=$sitetotest&browser=$browser&p_id=$p_id&OS=$o_id&b_id=$b_id&o_id=$o_id&host=$nodepath&ss=\\\\$network_drive\\\\$type\\\\$p_name&u_id=$u_id&p_name=$p_name&type=$type&suitename=$suitename&tests[]=$t_name&".'lang=en';
          echo "Could not run:<br />";
          echo $t_name ." @ '$description' in '$browser'";
          echo "<br />";
      }
  }
}
?>
