<?php
class commandList{
  public $dbh;
  public $id;
  public $status;
  public $action;
  public $var1;
  public $var2;
  public $t_id;  
  public $max;
  
  function __construct($id, $showPassed = false, $showFailed = true, $showNotDone = true, $showDone = false){
    
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
    
    if ($showNotDone == true){
      
      if ($first == true){
        $show .= "(status = 'notdone'";
        $first = false;
      }
      else{
        $show .= " OR status = 'notdone'";
      }
    }
    
    if ($showDone == true){
      
      if ($first == true){
        $show .= "(status = 'done'"; 
        $first = false;
      }
      else{
        $show .= " OR status = 'done'"; 
      }
    }


    $show .= ")";
    
    if (!$showPassed && !$showFailed && !$showNotDone && !$showDone){
      $show = "AND id='slamløsning'";
    }
    
    $this->dbh=new DBHandler();
    $result=$this->dbh->select('TRM_commands',"WHERE t_id='$id' $show ORDER BY ID ASC", '*');
    $num = mysql_numrows($result);
    
    for ($i=0;$i<$num;$i++){
      $this->id[$i]     = mysql_result($result,$i,"ID");
      $this->status[$i] = mysql_result($result,$i,"status");
      $this->action[$i] = mysql_result($result,$i,"action");
      $this->var1[$i]   = mysql_result($result,$i,"var1");
      $this->var2[$i]   = mysql_result($result,$i,"var2");
      $this->t_id[$i]   = mysql_result($result,$i,"t_id");
    }
    
    $this->max = $i;
  }

}
?>
