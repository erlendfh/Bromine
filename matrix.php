<?php 

function createMatrix($o, $b, $dbh){
  //include "DBHandler.class.php";
  //$dbh = new DBHandler();
  $OS = Array();
  $OSID = Array();
  $OSresult = $dbh->select('TRM_OS','','*');
  while($row = mysql_fetch_array($OSresult)){
  	array_push($OS,$row['OSname']);     
   	array_push($OSID,$row['ID']);
  	
  }
  $browserresult = $dbh->select('TRM_browser','','*');
  $Browser = Array();
  $BrowserID = Array();
  while($row = mysql_fetch_array($browserresult)){
  	array_push($Browser,$row['browsername']);
  	array_push($BrowserID,$row['ID']);
  }
  
  //$o = array('95','98','2000','Linux','Vista');
  //$b = array('IE7','IE6','Firefox');
  
  //echo array_search('IE6', $o);
  
  echo "<table>";
  echo "<tr>";
  echo "<td class='matrix'></td>";
  for ($i=0;$i<count($OS);$i++){
    echo "<td class='matrix'>$OS[$i]</td>";
  }
  echo "</tr>";
  for ($d=0;$d<count($Browser);$d++){
    echo "<tr>";
    echo "<td class='matrix'>$Browser[$d]</td>";
    $curB=$Browser[$d];
    for ($i=0;$i<count($OS);$i++){
      $curO=$OS[$i];
      $hasBrow = -1;  
      $hasOS = -1;
      /*
      $hasOS = array_search($curO, $o);
      $hasBrow = array_search($curB, $b);
      */
      //$curB == $bSuccess[$g] && $curO == $oSuccess[$g]
      $set=false;
      for ($p = 0; $p<count($o); $p++){
        if ($curB == $b[$p] && $curO == $o[$p]){
          echo "<td class='matrix'>";
          echo "X"; 
          echo "</td>";
          $set = true;
        }

      }
      if ($set==false){
          echo "<td class='matrix'>&nbsp;</td>";
      }
    }
    echo "</tr>";
  }
  echo "</table>";
}
function createMatrixAdv($oSuccess, $bSuccess, $oFailed, $bFailed, $oNotDone, $bNotDone,$toPrintSuccess,$toPrintFailed, $dbh){
  //include "DBHandler.class.php";
  //$dbh = new DBHandler();
  
  $OS = Array();
  $OSID = Array();
  $OSresult = $dbh->select('TRM_OS','','*');
  while($row = mysql_fetch_array($OSresult)){
  	array_push($OS,$row['OSname']);     
   	array_push($OSID,$row['ID']);
  	
  }
  $browserresult = $dbh->select('TRM_browser','','*');
  $Browser = Array();
  $BrowserID = Array();
  while($row = mysql_fetch_array($browserresult)){
  	array_push($Browser,$row['browsername']);
  	array_push($BrowserID,$row['ID']);
  }
  /*
  $oSuccess = array('95','2000');
  $bSuccess = array('IE7','Firefox');
  
  $oFailed = array('98','98');
  $bFailed = array('Firefox','IE7');
  
  $oNotDone = array('Linux','Linux','Linux');
  $bNotDone = array('Firefox','IEhta','IE7');
  */

  $final .= "<table>";

  $final .= "<tr>";
  $final .= "<td class='matrix' bgcolor='silver'><a href='javascript:Popup.hideLayer()'>".$dbh->getText('close')."</a></td>";
  for ($i=0;$i<count($OS);$i++){
    $final .= "<td class='matrix'>$OS[$i]</td>";
  }
  $final .= "</tr>";
  for ($d=0;$d<count($Browser);$d++){
    $final .= "<tr>";
    $final .= "<td class='matrix'>$Browser[$d]</td>";
    $curB=$Browser[$d];
    
    $max = count($oSuccess);
    if (count($oFailed) > $max){$max = count($oFailed);}
    if (count($oNotDone) > $max){$max = count($oNotDone);}
    
    for ($i=0;$i<count($OS);$i++){
      $curO=$OS[$i];

      $set = false;
      for ($g =0;$g<count($bSuccess);$g++){
        if ($curB == $bSuccess[$g] && $curO == $oSuccess[$g]){
          $final .= "<td class='matrix' bgcolor='#ccffcc'>";
          $s = split ('/',$toPrintSuccess[$g]);
          $s_id = $s[0];
          $t_id = $s[1];
          $final .= "<a class='full' href='showReport.php!112!id=$s_id!911!highlight=$t_id'>X</a>";
          $final .= "</td>";
          $set = true;
          
          //echo $toPrintSuccess[$g];
        }
      }
      
      for ($g =0;$g<count($bFailed);$g++){
        if ($curB == $bFailed[$g] && $curO == $oFailed[$g]){
          $final .= "<td class='matrix' bgcolor='#ffcccc'>";
          $s = split ('/',$toPrintFailed[$g]);
          $s_id = $s[0];
          $t_id = $s[1];
          $final .= "<a class='full' href='showReport.php!112!id=$s_id!911!highlight=$t_id'>X</a>";
          $final .= "</td>";
          $set = true;
          
          //echo $toPrintFailed[$g];
        }
      }
      
      for ($g =0;$g<count($bNotDone);$g++){
        if ($curB == $bNotDone[$g] && $curO == $oNotDone[$g]){
          $final .= "<td class='matrix' bgcolor='yellow'>";
          $final .= "X"; 
          $final .= "</td>";
          $set = true;
        }
      }
      
      if ($set == false){
        $final .= "<td class='matrix'>&nbsp;</td>";
      }

    }
    $final .= "</tr>";
  }
  $final .= "</table>";

  return $final;
}

//createMatrixAdv();
?>
