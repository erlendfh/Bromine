<?php
/*
datatest howto:

laver en test der hedder dataTest+type
laver en datafil med type = type

f.eks. testen: dataTestbager.php har datafilen: bager.txt hvor første linje er type=bager

testresultaterne får navnet dataTest+type, så testcase navnet skal være lig dataTest+type
*/

require_once('fileManager.php');
require_once('../../../DBHandler.class.php');
  
  class test{
    
    private $commands = array();
    private $name;
    private $status = 'failed';
    private $complete = false;
    private $passed = 0;
    private $failed = 0;
    private $done = 0;
    private $tHelp = '';
    private $verification;
    private $fm;
    private $arr;
    
    function __construct($s_id,$name, $verification){
      $this->s_id = $s_id;
      $this->name = $name;
      $this->verification = $verification."();";
      $this->tHelp = "Verification method: <i>".$verification."</i><br />";
      //$this->fm = new FileManager($logFile);
      $this->arr = array();
    }
    
    function getLastCommand(){
      return $this->commands[count($this->commands) - 1];
    }
    
    function setTHelp($newTxt){
      $this->tHelp .= $newTxt;
    }
    
    function addResult($command){
      if ($command->get('command') == 'testComplete'){
        $this->complete = true;
        eval ('$this->'.$this->verification);
        $this->finalizeTest();
      }
      if($command->get('status') == 'passed'){
        $this->passed++;
      }
      elseif($command->get('status') == 'failed'){
        $this->failed++;
      }
      else{
        $this->done++;
      }
      
      $this->commands[] = $command;
          
      $cmd = $command->toString();
      /*
      $noOfCmd = 40;
      array_unshift($this->arr,$cmd); 
      unset($this->arr[$noOfCmd]);
      $this->fm->write($this->arr, $noOfCmd);*/
    }
    
    function setStatus($newStatus){
      if($newStatus == false){
        $this->status = "failed";
      }
      else{
        $this->status = "passed";
      }
    }
    
    function get($var){
      return $this->$var;
    }
    
    function getAsArray(){
      //$arr = new Array($this->command, $this->args, $this->status);
    /*
    private $commands = array();
    private $name;
    private $status = 'failed';
    private $complete = false;
    private $passed = 0;
    private $failed = 0;
    private $done = 0;
    private $tHelp = '';
    private $verification;
    */
  
      
      for ($i = 0; $i<count($this->commands);$i++){
        $comArr = $this->commands[$i]->getAsArray();
        $totalComArr[] = $comArr; 
      }
      
      $arr = array ('name' => $this->name, 'status' => $this->status, 'complete' => $this->complete, 'noOfPassed' => $this->passed, 
                        'noOfFailed' => $this->failed, 'noOfDone' => $this->done, 'verificationMethod' =>  $this->verification , 'tHelp' => $this->tHelp , 'commandArray' => $totalComArr);
      //$comArr = 
      return $arr;
    }
    
    function createTest(){
      $lang = $_GET['lang'];
      $this->dbh = new DBHandler($lang);
      $testCreated = $this->dbh->getText('Test started');
      $this->t_id=$this->dbh->insert('TRM_test',
                  "
                  NULL,
                  '$this->status',
                  '$this->name',  
                  '$this->s_id',
                  '$this->tHelp'
                  ",
                  "
                  ID,
                  status,
                  name,
                  s_id,
                  Thelp
                  ");
      $u_id=$_GET['u_id'];
      $this->dbh->insert('TRM_tempcommands',
                  "
                  NULL,
                  '$u_id',
                  '$testCreated: ',  
                  '$this->name',
                  '',
                  'info'
                  ",
                  "
                  ID,
                  u_id,
                  action,
                  var1,
                  var2,
                  status
                  ");
      $this->dbh->disconnect();
      return $this->t_id;
    }
    
    function finalizeTest(){
      $this->dbh = new DBHandler();
      $this->dbh->update('TRM_test',"status = '$this->status'","id = $this->t_id");
      $this->dbh->disconnect();
    }
    
    function countCommands(){
      $count = $this->done + $this->failed + $this->passed;
      return $count;
    }
    
    function verifyNoneFailed(){
      if($this->failed > 0){$this->status = "failed";}
      else{$this->status = 'passed';}
    }
    
    function verifyAnyCommandTrue($start = 1, $end = 1){
      for ($i = 0;$i<count($this->commands); $i++){
        $status = $this->commands[$i]->get('status');
        if ($status == 'passed'){
          $count ++;
        }
        
        if ($count == $end){
          return true;
        }
      }
      
      return false; 
    
    }
    
    function verifyLastCommandTrue($offset = 1){
      if($this->complete == true){    
        if ($this->commands[count($this->commands) - $offset]->get('status') == 'passed'){
          $this->status = "passed";
          return true;  
        }
        else{
          $this->status = "failed";
          return false;
        }
      }
    }
    
    function verifyOnlyLastCommandFalse($offset = 1){
      if($this->complete == true){    
        if ($this->commands[count($this->commands) - $offset]->get('status') == 'failed' && $this->failed == 1){
          $this->status = "passed";
          return true;  
        }
        else{
          $this->status = "failed";
          return false;
        }
      }
    }
  }

?>
