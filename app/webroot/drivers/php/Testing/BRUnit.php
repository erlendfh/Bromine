<?php
/*
 * @Author Visti Kløft & Jeppe Poss
 * @Date 9 june 2009
 * @Description replacement for the normal unittest. Updates the database to
 * reflect the correct assertments 
 */ 


/*
 * Contains database information, always uses the default database from cakephp
 */
require_once "../config/database.php";

Class BRUnit {
    
    /*  Setups up the default selenium object and creates the connection for the database
     * @param $host ip of the node
     * @param $port port which the nodes run on
     * @param $browser which browser to execute test in
     * @param $sitetotest the url of the test site
     * @param $u_id unique identifier used by Bromine
     * @param $t_id the tests id used by Bromine
     */                
    function setUp($host, $port, $browser, $sitetotest, $u_id, $t_id, $debug)
    {
        $path = pathinfo($_SERVER['PHP_SELF']);
        $this->orginalPath = $path['dirname'];
        $this->modulesPath = $path['dirname'].'\\modules\\'; 
        $this->u_id = $u_id;
        $this->t_id = $t_id;
        $this->debug = $debug;
        
        if ($this->debug) $this->log(print_r($path,true)); 
        
        $this->sitetotest = $sitetotest;
        $this->selenium = new Testing_Selenium($browser, $sitetotest, $host ,$port);
        $result = $this->selenium->start();
        /*
        'host' => 'localhost',
		'login' => 'root',
		'password' => '',
		'database' => 'bromine',
        
        */
        $dbVars = New DATABASE_CONFIG();
        $host = $dbVars->default['host'];
        $login = $dbVars->default['login'];
        $password = $dbVars->default['password'];
        $database = $dbVars->default['database'];

        $this->db = mysql_connect($host, $login, $password);
        mysql_select_db($database, $this->db);
        $this->log(mysql_get_host_info($this->db));
    }

    /*
     * Teardown the selenium object
     */     
    
    function tearDown()
    {
        $this->selenium->stop();
    }
    
    /*
     * Assert the param is TRUE and updates command status and action in the database
     * @param $bool repression to verify 
     */     

    function assertTrue($bool){
        $this->log($bool);
        if($bool){
             $status = "passed";
        }
        else{
            $status = "failed";
        }
        
        $this->updateStatus($status);
        $this->updateAction(__FUNCTION__);
        
    }
    /*
     * Makes the test fail with a custom text, that will be inserted into the database
     * @param $text the text to be inserted into the database 
     */
     
    function fail($text){
        $this->customCommand($text,'failed','','');
        throw new Exception($text);
    }
    
    function waiting(){
        $this->updateStatus('waiting');
    }

    /*
     * Assert the param is FALSE and updates command status and action in the database
     * @param $bool expression to verify 
     */
     
    function assertFalse($bool){
        if(!$bool){
             $status = "passed";
        }
        else{
            $status = "failed";
        }
        
        $this->updateStatus($status);
        $this->updateAction(__FUNCTION__);
    }

    /*
     * Assert the params is EQUAL and updates command status and action in the database
     * @param $var1 first param to verify
     * @param $var2 second param to verify
     */

    function assertEquals($var1, $var2){
        if($var1 == $var2){
            $status = "passed";
        }
        else{
            $status = "failed";
        }
        
        $this->updateStatus($status, $var2);
        $this->updateAction(__FUNCTION__);
    }

    /*
     * Assert the params is NOT EQUAL and updates command status and action in the database
     * @param $var1 first param to verify
     * @param $var2 second param to verify
     */

    function assertNotEquals($var1, $var2){
        if($var1 != $var2){
            $status = "passed";
        }
        else{
            $status = "failed";
        }
        $this->updateStatus($status, $var2);
        $this->updateAction(__FUNCTION__);
    }
    
    /*
     * Updates the status of the last command in the database
     * @param $status the status to change it to 
     * @param (Optional) $var2 will be inserted in the database as var2, if given
     */
    
    private function updateStatus($status, $var2=''){
        $r = $this->sql("SELECT max(id) FROM commands WHERE test_id = " . $this->t_id);
        $last_id = mysql_result($r ,0);
        $sql = "UPDATE commands SET status='$status'";
        if($var2 != ''){
            $var2 = mysql_escape_string($var2);
            $sql .= ", var2='$var2' ";
        }
        $sql .= "WHERE id = $last_id";
        $this->sql($sql);
    }

    /*
     * Updates the action of the last command in the database
     * @param $name the status to change it to 
     */
    
    private function updateAction($action){
        $r = $this->sql("SELECT max(id) FROM commands WHERE test_id = " . $this->t_id);
        $last_id = mysql_result($r ,0);
        
        $r = $this->sql("SELECT action FROM commands WHERE id = " . $last_id);
        $old_action = mysql_result($r ,0);
        
        $sql = "UPDATE commands SET action='$action($old_action)' WHERE id = $last_id";
        $this->sql($sql);
    }

    /*
     * For debug, writes to a log file
     * @param $text to write
     */
    
    private function log($text){
        if ($this->debug){
            $fp = fopen('logs/BRUnit_output.txt','a');
            fwrite($fp, date('l jS \of F Y h:i:s A'). ': ' . $text."\n");
            fclose($fp);
        }
    }
    

    /**
     * Queries database with given SQL statement.
     *
     * @param string $sql SQL statement
     * @return Resultset, or inserted ID.
     */
    private function sql($sql) {
        $this->query = $sql;
        $this->log($this->query);
        if(!$result = mysql_query($this->query)){throw new Exception(mysql_error());}
        if (strpos($sql, 'REPLACE') !== false || strpos($sql, 'INSERT') !== false) {
            return mysql_insert_id();
        } else {
            return $result;
        }
    }

    /**
     * Can be used in the testscript for insertning a custom command
     *
     * @param $cmdName name of the command
     * @param $status status of the command
     * @param $var1 var1 of the command
     * @param $var2 var2 of the command               
     * @return Resultset, or inserted ID.
     */    

    function customCommand($cmdName, $status, $var1 = '', $var2 = '') 
    {
        $cmdName = mysql_real_escape_string($cmdName);
        $status = mysql_real_escape_string($status);
        $var1 = mysql_real_escape_string($var1);
        $var2 = mysql_real_escape_string($var2);
        
        $sql = "INSERT INTO `commands` (
            `id` ,
            `status` ,
            `action` ,
            `var1` ,
            `var2` ,
            `test_id`
            )
            VALUES (
            NULL , '$status', '$cmdName', '$var1', '$var2', '$this->t_id'
            );";
        $this->sql($sql);
    }
    
    /*
     * Includes a module to be used in the testcase
     * @param filename - the file to be included
     */                   
    function loadModule($filename){
        include($this->modulesPath . $filename.".php");
    }
    
}
    /**
     * Function used to start the test
     *
     * @param $name name of the test class 
     * @param $argv arguments from bromine
     */
     
function startTest($name, $args='', $debug = true){

    $host = $args[1];
    $port = $args[2];
    $browser = $args[3];
    $sitetotest = $args[4];
    $u_id = $args[5];
    $t_id = $args[6];
    $brows2 = $browser.",".$u_id;
    $datafile = $args[7];
  /*  
    // Debug
    $host = '127.0.0.1';
    $port = '80';
    $browser = '*chrome';
    $sitetotest = 'http://google.com';
    $u_id = '60000';
    $t_id = '60000';
    $brows2 = $browser.",".$u_id;
    $datafile = $args[7]; 
    */
    
    $t = new $name();
    $t->setUp($host, $port, $brows2, $sitetotest, $u_id, $t_id, $debug);
    try{       
        $t->testMyTestCase();
    }
    catch (Exception $e){
        var_dump($e);
    }
    
    $t->tearDown();
}

?>
