<?php
    error_reporting(E_ALL & ~E_NOTICE);
    set_error_handler(create_function('$x, $y', 'throw new Exception($y, $x);'), E_ALL & ~E_NOTICE);

    try{
        include('../../Bromine/libs/DBHandler.php');
        
        $dbh = new DBHandler();
        
        function insertCommand($status, $cmd, $var1, $var2, $t_id, $u_id){
            $status=mysql_real_escape_string($status);
            $cmd=mysql_real_escape_string($cmd);
            $var1=mysql_real_escape_string($var1);
            $var2=mysql_real_escape_string($var2);
            $t_id=mysql_real_escape_string($t_id);
            $u_id=mysql_real_escape_string($u_id);
            global $dbh;
            $dbh->sql("INSERT INTO trm_commands (ID,status,action,var1,var2,t_id) VALUES (NULL,'$status','$cmd','$var1','$var2','$t_id')");
            $dbh->insert('trm_tempcommands', "NULL, '$u_id', '$cmd', '$var1', '$var2', '$status' ", " ID, u_id, action, var1, var2, status ");
            return true;    
        }
        
        function getStatus($response){ //Figures out the status of the command
            $status = "done";

            if(preg_match('/true/', $response) ){
                $status = "passed";
            }
            if(preg_match('/false/', $response) ){
                $status = "failed";
            }
            return $status;
        }
        
        function executeCommand($url){

            $handle = fopen($url, 'r');
            stream_set_blocking($handle, false);
            $response = stream_get_contents($handle);
            fclose($handle);
            
            return $response;
        }
 
        //START
        
        $cmd = $_REQUEST['cmd'];
        $one = $_REQUEST['1'];
        $two = $_REQUEST['2'];
        $sessionId = $_REQUEST['sessionId'];
        
        //If custom command, just insert in the DB and be done with it.
        if($cmd == 'customCommand'){ 
            $cmdName = $_REQUEST['cmdName'];
            $status = $_REQUEST['status'];
            $t_id = $_REQUEST['t_id'];
            $u_id = $_REQUEST['u_id'];
            $var1 = $_REQUEST['var1'];
            $var2 = $_REQUEST['var2'];          
            insertCommand($status, $cmdName, $var1, $var2, $t_id, $u_id);
            echo "OK";
            exit;      
        }
        //Else if, first command, use u_id for DB identification
        elseif ($cmd == 'getNewBrowserSession'){ 
            $arr = split(',',$one);
            $one = $arr[0];
            $u_id = $arr[1];
            $result = $dbh->sql("SELECT * FROM trm_selenium_server_vars WHERE u_id = '$u_id'");
        }
        //All other commands, use sessionId
        else{ 
            $result = $dbh->sql("SELECT * FROM trm_selenium_server_vars WHERE sessionId = '$sessionId'");
        }
        
        //Grab the data from the DB
        while ($row = mysql_fetch_array($result)) { 
            $nodepath = $row['nodepath'];
            $u_id = $row['u_id'];
            $t_id = $row['t_id'];
        }
        
        //Send the command to the RC server
        $url = "http://$nodepath:4444/selenium-server/driver/?cmd=$cmd&1=$one&2=$two&sessionId=$sessionId";
        $response = executeCommand($url);
        
        //Determine status
        if (preg_match('/^OK/', $response) ) { 
            $status = getStatus($response);
        }else{
            $status = 'failed';
            $two .= " | $response";
        }
        
        //Insert the command in Bromine
        insertCommand($status, $cmd, $one, $two, $t_id, $u_id); 

        //If first command, update DB with sessionId 
        if ($cmd == 'getNewBrowserSession'){
            $sessionId = end(split(',',$response));
            $dbh->sql("UPDATE trm_selenium_server_vars SET sessionId='$sessionId' WHERE u_id='$u_id'");
        }
        //If NOTHING messed up, send the response
        echo $response;
        //END

    }catch(Exception $e){
        $req = print_r($_REQUEST, true);
        $timedate = date("m.d.y H:i:s");   
        $msg = "$timedate \n Called with: $req \n Url created: $url \n Got response: $response \n ***ERROR***: $e \n\n";
        if(file_exists('log.txt')){
            $fp = fopen('log.txt','r');
            $prev_cont = file_get_contents('log.txt');
            fclose($fp);
        }
        $fp = fopen('log.txt','w');
        fwrite($fp,$msg.$prev_cont);
        fclose($fp);
        $short_msg="<br /><br /><b>ERROR: index.php suffered an error:<br /></b> <i>$e</i><br /><b>Check the <a href='../selenium-server/driver/log.txt' target='_blank'>log</a> for details.</b><br /><br />";
        echo $short_msg;
        if($t_id!='' && $u_id!=''){
            insertCommand('failed', '', '', $short_msg, $t_id, $u_id);
        }
    }
    restore_error_handler();
    
?>
