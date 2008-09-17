<?php
    //error_reporting(E_ALL & ~E_NOTICE);
    set_error_handler(create_function('$x, $y', 'throw new Exception($y, $x);'), E_ALL & ~E_NOTICE);
    try{
        include('../../Bromine/libs/DBHandler.php');
        
        $dbh = new DBHandler();
        
        function createCommand($status, $cmd, $var1, $var2, $t_id, $u_id){
            global $dbh;
            $dbh->sql("INSERT INTO trm_commands (ID,status,action,var1,var2,t_id) VALUES (NULL,'$status','$cmd','$var1','$var2','$t_id')");
            $dbh->insert('trm_tempcommands', "NULL, '$u_id', '$cmd', '$var1', '$var2', '$status' ", " ID, u_id, action, var1, var2, status ");    
        }

        $cmd = $_REQUEST['cmd'];
        $one = $_REQUEST['1'];
        $two = $_REQUEST['2'];
        $sessionId = $_REQUEST['sessionId'];
        $custom = false;
        
        if ($cmd == 'getNewBrowserSession'){
            $arr = split(',',$one);
            $one = $arr[0];
            $u_id = $arr[1];
            $result = $dbh->sql("SELECT * FROM trm_selenium_server_vars WHERE u_id = '$u_id'");
        }
        elseif($cmd == 'customCommand'){
            $custom = true;
            $cmdName = $_GET['cmdName'];
            $status = $_GET['status'];
            $t_id = $_GET['t_id'];
            $u_id = $_GET['u_id'];
            $var1 = $_GET['var1'];
            $var2 = $_GET['var2'];          
            createCommand($status, $cmdName, $var1, $var2, $t_id, $u_id);      
        }
        else{
            $result = $dbh->sql("SELECT * FROM trm_selenium_server_vars WHERE sessionId = '$sessionId'");
        }
        
        while ($row = mysql_fetch_array($result)) {
            $nodepath = $row['nodepath'];
            $u_id = $row['u_id'];
            $t_id = $row['t_id'];
        }
        
        $url = "http://$nodepath:4444/selenium-server/driver/?cmd=$cmd&1=$one&2=$two&sessionId=$sessionId";
        
        $handle = fopen($url, 'r');
        stream_set_blocking($handle, false);
        $response = stream_get_contents($handle);
        fclose($handle);
    
        echo $response;
        
        
        if ($cmd == 'getNewBrowserSession')
        {
            $sessionId = end(split(',',$response));
            $dbh->sql("UPDATE trm_selenium_server_vars SET sessionId='$sessionId' WHERE u_id='$u_id'");
        }
        
        function getStatus($response){ //Figures out the status of the command
            $r=split(",",$response);
            if(count($r) > 1){
              $status = $r[1];
            }
            if(isset($status)){
              if ($status == "true"){
                return "passed";
              }
              elseif ($status == "false"){
                return "failed";
              }
            }
            return "done";
        }
        
        if (preg_match('/^OK/', $response) ) {
            $status = getStatus($response);
        }else{
            $status = 'failed';
            $two = $response;
        }
        
        function createCommand($status, $cmd, $var1, $var2, $t_id, $u_id){
            global $dbh;
            $dbh->sql("INSERT INTO trm_commands (ID,status,action,var1,var2,t_id) VALUES (NULL,'$status','$cmd','$var1','$var2','$t_id')");
            $dbh->insert('trm_tempcommands', "NULL, '$u_id', '$cmd', '$var1', '$var2', '$status' ", " ID, u_id, action, var1, var2, status ");    
        }

    }catch(Exception $e){
        
        $fp = fopen('log.txt','a');
        $req = print_r($_REQUEST, true);
        $msg = "Called with: $req \n Sent: $url \n Got response: $response \n Error: $e \n\n";
        fwrite($fp,$msg);
        fclose($fp);
        createCommand('failed', $cmd, $one, $two."ERROR: index.php suffered an error. Check the log for details.", $t_id, $u_id);
        echo "ERROR: index.php suffered an error. Check the log for details.";
    }
    restore_error_handler();
    
?>
