<?php

require_once ('../../../libs/DBHandler.php');
class command{

  private $command;
  private $args = array();
  private $response;
  private $status;
  private $helpText;
  private $var1;
  private $var2;
  
  function __construct($t_id, $command, $args, $response, $status, $helpText = ""){
    $this->command = $command;
    $this->args = $args;
    $this->response = $response;
    $this->status = $status;
    $this->helpText = $helpText;
    $this->t_id = $t_id;
    
    $this->createCommand();
  }
  
  function view(){
    echo "*******************<br />";
    echo "Command:".$this->command."<br />";
    echo "Arguments:";
    print_r($this->args);
    echo "<br />";
    echo "Response:".$this->response."<br />";
    echo "Status:".$this->status."<br />";
    echo "*******************<br />";
    
  }
  
  function toString(){

    if (!isset ($this->args[1])){
      $this->args[1] = "";
    }
    if (!isset ($this->args[0])){
      $this->args[0] = "";
    }
    /*
    .status_passed {background-color: #ccffcc;}
    .status_failed {background-color: #ffcccc;}
    .statusNotDone {background-color: yellow ;}
    .status_notdone {background-color: yellow ;}
    .status_done {background-color: #eeffee; }
    */
    if ($this->status == 'passed'){
      $bgcolor = 'status_passed';
    }
    elseif ($this->status == 'failed'){
      $bgcolor = 'status_failed';
    }
    else{
      $bgcolor = 'status_done';
    }
    $return = 
    "<tr class=".$bgcolor."><td>".$this->command."</td><td>".$this->args[0]."</td><td>".$this->args[1]."</td><td>".$this->response."</td></tr>\n";
    
    return $return;
  }
  
  function get($var){
    return $this->$var;
  }
  
  function setStatus($newStatus){
    if ($newStatus == 'passed' || $newStatus == 'failed'){
      $this->status = $newStatus;   
    }
  }
  
  function getAsArray(){
    $arr = array('command' => $this->command, 'arguments' => $this->args, 'status' =>  $this->status);
    return $arr;
  }

  function createCommand(){
    $dbh = new DBHandler();
    $this->command = mysql_real_escape_string($this->command);
    $this->var1 = mysql_real_escape_string($this->args[0]);
    $this->var2 = mysql_real_escape_string($this->args[1]);
    $dbh->insert('TRM_commands',
            "
            NULL,
            '$this->status',
            '$this->command',
            '$this->var1',
            '$this->var2',  
            '$this->t_id'
            ",
            "
            ID,
            status,
            action,
            var1,
            var2,
            t_id
            ");
    $u_id = $_GET['u_id'];
    $dbh->insert('TRM_tempcommands',
            "
            NULL,
            '$u_id',
            '$this->command',
            '$this->var1',
            '$this->var2',  
            '$this->status'
            ",
            "
            ID,
            u_id,
            action,
            var1,
            var2,
            status
            ");
    $dbh->disconnect();
      }
  }


?>
