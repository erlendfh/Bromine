<?php include_once ('getprotect.php'); ?>
<?php
    /*
    echo "<pre>";
    print_r($_REQUEST);
    echo "</pre>";
    */
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
      <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
    <div id='progress'></div>
    <div id='state'></div>
<?php
    

    $url1 = "statusRC.php?time=$time&user=$user&pass=$pass&u_id=$u_id";
    $url = "genericSuite.php?";
    foreach($_REQUEST as $key => $value){
        if(is_array($value)){
            foreach($value as $value2){
                $url .= "$key"."[]=$value2&";
            }
        }else{
            $url .= "$key=$value&";
        }
    }
    $url .= "u_id=$u_id";

    if($datafile != ''){
        $tests = array_unique($tests);
        foreach($datafile as $value){
            $url.= "&datafile[]=$value";
        }
    }
    
?>
      
      
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
  /*
}else{
    $noderesult = $dbh->select('TRM_nodes', "", "*");
    while ($row = mysql_fetch_array($noderesult)) {
        $nodeid = $row['ID'];
        $nodepath = $row['nodepath'];
        $node_o_id = $row['o_id'];
        $msg = BromineUtilities::checkJavaServer($nodepath);
        //echo "$nodepath";
        if($msg!='Online'){
          //echo " not online!<br>";
          $offlineServers[] = $node_o_id;
        }
        else{
           $onlineServers[] = $node_o_id;
          //echo " online!<br>";
        }

    }

  $result = $dbh->select('TRM_ReqsOSBrows, TRM_nodes, TRM_nodes_browsers, TRM_ReqsTests, TRM_requirements', "
  WHERE 
  TRM_ReqsOSBrows.r_id = $r_id AND
  TRM_ReqsOSBrows.o_id = TRM_nodes.o_id AND
  TRM_ReqsOSBrows.b_id = TRM_nodes_browsers.b_id AND
  TRM_nodes.ID = TRM_nodes_browsers.n_id AND
  TRM_ReqsTests.r_id = $r_id AND
  TRM_requirements.id = $r_id 
  GROUP BY TRM_nodes.o_id,TRM_nodes_browsers.b_id,t_name
  ", "TRM_nodes_browsers.n_id,TRM_nodes.o_id,TRM_nodes_browsers.b_id,network_drive,TRM_nodes.description as description,nodepath,t_name, TRM_requirements.name as r_name, TRM_nodes_browsers.browser_path as browser");
  //echo $dbh->getQuery();
  $kk = rand(0, 10000);
  while ($row = mysql_fetch_array($result)) {
      $u_id = str_replace('.', '', microtime('U')) . rand(0, 1000);
      $b_id = $row['b_id'];
      $n_id = $row['n_id'];
      $t_name = $row['t_name'];
      $browser = $row['browser'];
      $description = $row['description'];
      $suitename = "$kk Requirement: ".$row['r_name']. " Test: $t_name";
      $nodepath = $row['nodepath'];
      $network_drive = $row['network_drive'];
      $browsername = $row['browsername'];
      $url = "RC/Drivers/$type/$test?sitetotest=$sitetotest&browser=$browser&p_id=$p_id&OS=$o_id&b_id=$b_id&o_id=$o_id&host=$nodepath&ss=\\\\$network_drive\\\\$type\\\\$p_name&u_id=$u_id&p_name=$p_name&type=$type&suitename=$suitename&tests[]=$t_name&".'lang=en';
      $o_id = $row['o_id'];
      if (array_search($o_id, $onlineServers) !== false){  
          
          /*echo "Did run:<br />";
          echo $t_name ." @ '$description' in '$browser'";
          echo "<br />";
          *
          $img = "<img src='img/ajax-loader.gif' style='height: 20px; width: 20px;'/>";
          echo "<script type='text/javascript'>";
          echo 'document.getElementById("progress").innerHTML+="<b>started running: '. $t_name ." @ '$description' in '$browser'</b>".' Status: <div style='."'".'margin-left: 40px;'."'".' id='."'".$u_id."'>".$img.' Running...</div><br /><br />\n";';
          echo "new Ajax.Updater('$u_id','$url');";
          echo "</script>\n";  
      }
      else{
       
          echo "Could not run:<br />";
          echo $t_name ." @ '$description' in '$browser'";
          echo "<br />";
      }
  }
}
*/
?>
