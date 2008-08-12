<?php

    require_once('libs/DBHandler.php');
    require_once('error_reporting.php');
    
    class Test{
            
        function __construct($s_id,$name){
            $this->s_id = $s_id;
            $this->name = $name;
            $this->u_id = $_GET['u_id'];
            $this->dbh = new DBHandler($_GET['lang']);
        }
        
        function createTest($type){
            $testCreated = $this->dbh->getText('Test started');
            $this->t_id=$this->dbh->insert('TRM_test', "NULL, '', '$this->name', '$this->s_id', '$type' ","ID,status, name, s_id, Thelp");
            $this->dbh->insert('TRM_tempcommands', "NULL, '$this->u_id', '$testCreated: ', '$this->name', '$type', 'info' ", " ID, u_id, action, var1, var2, status "); 
            return $this->t_id;
        }
        
        function finalizeTest(){
            $status='passed';
            if(mysql_num_rows($this->dbh->select('TRM_commands', "WHERE t_id='$this->t_id' AND status='failed'", "*"))>0){
                $status='failed';
            }
            $this->dbh->update('TRM_test',"status = '$status'","id = '$this->t_id'");
        }
        
    }
?>
