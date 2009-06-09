<?php
class SeleniumserverController extends AppController {
	var $name = 'Seleniumserver';
	var $layout = null;
	//var $uses = array('commands','seleniumservers');
	
	function beforeFilter(){
        $this->Auth->allow('*');
    }
	
	function driver(){
    	App::import('Model','Command');
    	$this->Command = new Command();
	    $this->Test = new Test();
	    
	   //$this->viewer = null;
	   Configure::write('debug', 0);  
	   //$this->RequestHandler->setContent('txt');
        $cmd = $_REQUEST['cmd'];
        $one = $_REQUEST['1'];
        $two = $_REQUEST['2'];
        if (!isset($_REQUEST['1'])){
            $one = '';
        }
        if (!isset($_REQUEST['2'])){
            $two = '';
        }
        if (isset($_REQUEST['sessionId'])){
            $sessionId = $_REQUEST['sessionId'];
        }else{
            $sessionId = "";
        }
        
        
        
        //If, first command, use uid for DB identification
        if ($cmd == 'getNewBrowserSession'){ 
            $this->log(print_r($arr));
            $arr = split(',',$one);
            $one = $arr[0];
            $uid = $arr[1];
            $result = $this->Seleniumserver->find("uid = '$uid'");
            $this->log('GetNewBrowserSession, '.$uid);
        }
        //All other commands, use sessionId
        else{ 
            //$result = $dbh->sql("SELECT * FROM trm_selenium_server_vars WHERE sessionId = '$sessionId'");
            $result = $this->Seleniumserver->find("session = '$sessionId'");        
            $this->log($cmd . ' on session ' . $sessionId);
        }
        if($cmd == 'customCommand'){ //If custom command, just insert in the DB and be done with it.
            $cmdName = $_REQUEST['cmdName'];
            $status = $_REQUEST['status'];
            $test_id = $_REQUEST['test_id'];
            $uid = $_REQUEST['u_id'];
            $var1 = $_REQUEST['var1'];
            $var2 = $_REQUEST['var2'];          
            $this->insertCommand($status, $cmdName, $var1, $var2, $test_id, $uid, $sessionId);
            echo "OK";
            $this->log("Custom command: cmd='$cmdName' & 1='$var1' & 2='$var2'");
            exit;
        }
        //Grab the data from the DB
        //pr ($result);
        $nodepath = $result['Seleniumserver']['nodepath']; //Must be an IP!!!! localhost will fuck it up
        $uid = $result['Seleniumserver']['uid'];
        $test_id = $result['Seleniumserver']['test_id'];
        //Send the command to the RC server
        $url = "http://$nodepath/selenium-server/driver/?cmd=$cmd&1=$one&2=$two&sessionId=$sessionId";
        $this->log("Executing $url");
        $response = $this->executeCommand($url);
        
        $this->log($url . " returned: '" . $response . "'");
        //Determine status
        if (preg_match('/^OK/', $response) ) { 
            $status = $this->getStatus($response);
        }else{
            $status = 'failed';
            $two .= " | $response";
        }
        
        //Insert the command in Bromine
        $this->insertCommand($status, $cmd, $one, $two, $test_id, $uid, $sessionId);
        //If first command, update DB with sessionId 
        if ($cmd == 'getNewBrowserSession'){
            $sessionId = end(split(',',$response));
            
            $this->Seleniumserver->updateAll(
              array(
                'Seleniumserver.session' => "'$sessionId'"
              ),"Seleniumserver.uid = '$uid'"
            ); 
            $this->log("Updated DB with session: '$sessionId' on uid: '$uid'");
            //$dbh->sql("UPDATE trm_selenium_server_vars SET sessionId='$sessionId' WHERE uid='$uid'");
        }
        
        //If NOTHING messed up, send the response
        echo $response;
        //echo "OK";
        //END
    
        /*
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
            if($test_id!='' && $u_id!=''){
                insertCommand('failed', '', '', $short_msg, $test_id, $u_id);
            }
        }
        */
        
    }
    
    private function insertCommand($status, $cmd, $var1, $var2 = '', $test_id, $uid, $sessionId){
        $command = array(
            'Command' => array(
                'status' => $status,
                'action' => $cmd,
                'var1' => $var1,
                'var2' => $var2,
                'test_id' => $test_id
            )
        );
        $this->Command->save($command);
        
        $conditions = array( "or" => array (
            "Seleniumserver.session" => $sessionId,
            "Seleniumserver.uid" => $uid
            )
        );
        $seleniumserver = $this->Seleniumserver->find($conditions);
        $seleniumserver['Seleniumserver']['lastCommand'] = time();
        if($cmd == 'testComplete'){
            $seleniumserver['Seleniumserver']['done'] = 1;
            //$count = $this->Test->find('count', array('conditions' => array('Test.status' => 'failed', 'Test.id' => "$test_id")));
            
        $conditions = array('Command.test_id' => $test_id, 'Command.status' => 'failed');
        $cmds = $this->Command->find($conditions);
        
        if (empty($cmds)){
            $test = array(
                'Test' => array(
                    'status' => 'passed',
                    'id' => $test_id
                )
            );
            $this->Test->save($test);
        }
        else{
            $test = array(
                'Test' => array(
                    'status' => 'failed',
                    'id' => $test_id
                )
            );
            $this->Test->save($test);
        }
        
            
        }
        $this->Seleniumserver->save($seleniumserver);
        
    }
    private function getStatus($response){ //Figures out the status of the command
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
    
    function log($text){
        $uid = str_replace('.', '', microtime('U'));
        $fp = fopen('log.txt','a');
        fwrite($fp,$uid . ": " . "$text\n");
        fclose($fp);
    }
}
?>
