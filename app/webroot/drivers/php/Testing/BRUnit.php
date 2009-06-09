<?php

//set_include_path(get_include_path() . PATH_SEPARATOR . "drivers/php");
require_once "../config/database.php";
Class BRUnit {

    function test(){
        $this->setUp(1,2,3,4,1,1);
        $this->assertTrue(false);
    }

    function setUp($host, $port, $browser, $sitetotest, $u_id, $t_id)
    {
        $this->log('setUp started!');
        $this->u_id = $u_id;
        $this->t_id = $t_id;
        $this->selenium = new Testing_Selenium($browser, $sitetotest, $host ,$port);
        $result = $this->selenium->start();
        $this->db = new db001;
        $dbVars = New DATABASE_CONFIG();

        if (!$this->db->connect($dbVars->default['host'], $dbVars->default['login'], $dbVars->default['password'], $dbVars->default['database'], true)) 
           $this->db->print_last_error(false);
    }
    
    function tearDown()
  {
    $this->selenium->stop();
  }
    

    function assertTrue($bool){
        $this->log($bool);
        if($bool){
             $status = "passed";
        }
        else{
            $status = "failed";
        }
        
        $last_id = $this->db->select_one("SELECT max(id) FROM commands WHERE test_id = " . $this->t_id);
        $data = array('status' => $status);
        $rows = $this->db->update_array('commands', $data, "id=$last_id");
    }
    
    function assertFalse($bool){
        if(!$bool){
             $status = "passed";
        }
        else{
            $status = "failed";
        }
        
        $last_id = $this->db->select_one("SELECT max(id) FROM commands WHERE test_id = " . $this->t_id);
        $data = array('status' => $status);
        $rows = $this->db->update_array('commands', $data, "id=$last_id");
    }

    function assertEquals($var1, $var2){
        if($var1 == $var2){
            $status = "passed";
        }
        else{
            $status = "failed";
        }
        
        $last_id = $this->db->select_one("SELECT max(id) FROM commands WHERE test_id = " . $this->t_id);
        $data = array('status' => $status);
        $rows = $this->db->update_array('commands', $data, "id=$last_id");
    }
    
    function assertNotEquals($var1, $var2){
        if($var1 != $var2){
            $status = "passed";
        }
        else{
            $status = "failed";
        }
        $last_id = $this->db->select_one("SELECT max(id) FROM commands WHERE test_id = " . $this->t_id);
        $data = array('status' => $status);
        $rows = $this->db->update_array('commands', $data, "id=$last_id");
    }
    
    function log($text){
        $fp = fopen('C:\logs\log_BR.txt','a');
        fwrite($fp, time(). ': ' . $text."\n");
        fclose($fp);
    }
}

//$br = new BRUnit();
//$br->test();
?>
