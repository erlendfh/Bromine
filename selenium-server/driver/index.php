<?php
    try{
    error_reporting(E_ERROR);
    include('../../Bromine/libs/DBHandler.php');
    
    $dbh = new DBHandler();

    $cmd = $_REQUEST['cmd'];
    $one = $_REQUEST['1'];
    $two = $_REQUEST['2'];
    $sessionId = $_REQUEST['sessionId'];
    
    if ($cmd == 'getNewBrowserSession'){
        $arr = split(',',$one);
        $one = $arr[0];
        $nodepath = $arr[1];
        $u_id = $arr[2];
        $t_id = $arr[3];
    }else{
        $result = $dbh->sql("SELECT * FROM TRM_selenium_server_vars WHERE sessionId = '$sessionId'");
        while ($row = mysql_fetch_array($result)) {
            $nodepath = $row['nodepath'];
            $u_id = $row['u_id'];
            $t_id = $row['t_id'];
        }
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
        $dbh->sql("INSERT INTO TRM_selenium_server_vars (sessionId, nodepath, u_id, t_id) VALUES ('$sessionId','$nodepath','$u_id','$t_id')");
    }
    
    function getStatus($response){ //Figures out the status of the command
        if (!preg_match('/^OK/', $response) ) {
            return "failed";
        }
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
    
    function createCommand($status, $cmd, $var1, $var2, $t_id, $u_id){
        global $dbh;
        $dbh->sql("INSERT INTO TRM_commands (ID,status,action,var1,var2,t_id) VALUES (NULL,'$status','$cmd','$var1','$var2','$t_id')");
        $dbh->insert('TRM_tempcommands', "NULL, '$u_id', '$cmd', '$var1', '$var2', '$status' ", " ID, u_id, action, var1, var2, status ");    
    }
    
    $status = getStatus($response);
    
    createCommand($status, $cmd, $one, $two, $t_id, $u_id);
    
    }catch(Exception $e){
        $fp = fopen('log.txt','a');
        fwrite($fp,'kk\n');
        $e2 = print_r($e,true);
        fwrite($fp,"$e2");
        fclose($fp);
    }
    
?>
