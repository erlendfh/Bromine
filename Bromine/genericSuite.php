<?php
    require_once('error_reporting.php'); 
    include "suite.php";
    include "test.php";
    include_once "libs/DBHandler.php";

    if(ini_get("max_execution_time")<60000){
        if(ini_set("max_execution_time", "60000")===false){
            echo "<p style='background-color: lightred;'> You need to manually set your max_execution_time in php.ini to a number higher than 60000 </p>";
        }
    }
    
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
    $u_id = $_GET['u_id'];
    
    $dbh = new DBHandler($lang);
    
    $ntest = false;
    if(isset($_GET['tests'])){
        if (is_array($_GET['tests'])){
          $tests = $_GET['tests']; 
        }
        else{
          $tests = array($_GET['tests']);
        }
    $ntest = true;
    }
    
    //Datatest Kneppes motorsavsmasakre!
    $datatest = false;
    if(isset($_GET['datafile'])){
        if (is_array($_GET['datafile'])){
          $datafile = $_GET['datafile']; 
        }
        else{
          $datafile = array($_GET['datafile']);
        }
        $datatest = true;
    }
    
    $noderesult = $dbh->select('trm_nodes', "WHERE ID=$n_id", "*");
    while ($row = mysql_fetch_array($noderesult)) {
      $o_id = $row['o_id'];
      $network_drive = $row['network_drive'];
      $nodepath = $row['nodepath'];
    }
    $typeresult = $dbh->select('trm_types', "", "*");
    while ($row = mysql_fetch_array($typeresult)){
      $id = $row['ID'];
      $types[$id]['typename'] = $row['typename'];
      $types[$id]['command'] = $row['command'];
      $types[$id]['spacer'] = $row['spacer'];
      $types[$id]['extension'] = $row['extension'];
    }
    $browsresult = $dbh->select('trm_nodes_browsers', "WHERE b_id=$b_id AND n_id=$n_id", "*");
    while ($row = mysql_fetch_array($browsresult)) {
      $browser = $row['browser_path'];
    }
    
    $suite = new Suite($suitename);
    $s_id = $suite->createSuite($suitename, $sitetotest, $b_id, $o_id, '', $p_id);
    echo "<br />";
    if($ntest == true && $datatest == false){
        foreach($tests as $value) {
            $kk = split(',',$value);
            $testname = $kk[0];
            $typeid = $kk[1];
            
            $typename = $types[$typeid]['typename'];
            $command = $types[$typeid]['command'];
            $spacer = $types[$typeid]['spacer'];
            $extension = $types[$typeid]['extension'];  
                
            $test = new Test($s_id,$testname);
            $t_id = $test->createTest($typename);
            
            $exec = "$command RC/$typename/$p_name/$testname.$extension".
                $spacer.
                    '127.0.0.1'.
                $spacer.
                    "80".
                $spacer.
                    $browser.
                $spacer.
                    $sitetotest.
                $spacer.
                    $nodepath.
                $spacer.
                    $u_id.
                $spacer.
                    $t_id;
            echo "<p style='background-color: lightgrey;'>The response of $testname ($typename) was: </p><br />";
            passthru("$exec"); //Does the actual running
            echo "<br /><br />";
            $test->finalizeTest();
        
        }
    }
    echo "<br />";
    echo "<br />";
    echo "<p style='background-color: lightgreen;'>".$suite->finalizeSuite()."</p>";

?>
