<?php
include_once('DBHandler.class.php');
include_once('commandList.class.php');
class testList{
  var $dbh;
  
  public $id;
  public $status;
  public $manstatus;
  public $name;
  public $s_id;
  public $commandList;
  
  public $max;
  function __construct($id, $showPassed = true, $showFailed = true){
  
    $show = "AND ";
    $first = true;
    if ($showPassed == true){
      $show .= "(status = 'passed'"; 
      $first = false;
    }
    
    if ($showFailed == true){
      
      if ($first == true){
        $show .= "(status = 'failed'";
        $first = false;
      }
      else{
        $show .= " OR status = 'failed' ";
      }
    }

    //echo $show."<br />";

    $show .= ")";
    
    if (!$showPassed && !$showFailed){
      $show = "AND id='slamløsning'";
    }
  
  
  
      $this->dbh=new DBHandler();
      $result=$this->dbh->select('TRM_test',"WHERE s_id='$id' $show ORDER BY ID ASC", '*');

      $num = mysql_numrows($result);
      for ($i=0;$i<$num;$i++){
      
        $this->id[$i]     = mysql_result($result,$i,"ID");
        $this->status[$i] = mysql_result($result,$i,"status");
        $this->name[$i]   = mysql_result($result,$i,"name");
        $this->s_id[$i]   = mysql_result($result,$i,"s_id");
        $this->Thelp[$i]   = mysql_result($result,$i,"Thelp");
        $this->manstatus[$i]   = mysql_result($result,$i,"manstatus");
        $this->commandList[$i] = new commandList($this->id[$i]);

      }

      $this->max = $i;
      
      
  } 
}
?>
