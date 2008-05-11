<?php
  include_once('protected.php');
  $in =$GLOBALS['_POST'];
  //print_r($in);
  /*
  Array
  (
      [td_id] => 1
      [tc_name] => Min f�rste manuelle test i Bromine
      [action] => Array
          (
              [1] => �ben http://www.krak.dk
              [2] => klik p� firma-fanen
              [3] => S�g p� vvs i firmas�gning
              [4] => Blow me
              [5] => Blow me
          )
  
      [reaction] => Array
          (
              [1] => Krak.dk �bner som den skal!
              [2] => Se at den �bner som den skal
              [3] => Se at resultat sider hvis firmaer der har noget med VVS at g�re 
              [4] => YES SIR!
              [5] => YES SIR!
          )
  
      [newaction] => ny aktion
      [newreaction] => ny reaktion
  )
  */
    $p_id=$_SESSION['p_id'];
    $td_id = $in['td_id'];
    $tc_description = $in['tc_description'];
    if($td_id=='new'){$td_id='';}
    $tc_name = $in['tc_name'];
    $tc_name=strtolower(str_replace(' ','_',$tc_name));
    $ugly=array('!',',','.','-','"',"'",'#','�','%','&','/','(',')','=','?','`','@','�','$','�','{','[',']','}','+','|','<','>','*','^','~','�','\\','�','�','�','�','�','�');
    $tc_name=str_replace($ugly,'',$tc_name);
    $newtest = $in['newtest'];
    $action=$in['action'];
    
    
    $orderby=$in['orderby'];
    $reaction=$in['reaction'];
    $newaction=$in['newaction'];
    $newreaction=$in['newreaction'];
    $neyorderby=$in['neworderby'];
    
    $should_be_neworderby=$in['should_be_neworderby'];
    
    if (is_array($orderby)){
      $result = array_unique($orderby);
      
      if (count($result) != count($orderby)){ $error2= 'Det er nogo at have to af de samme orderby!';}
    }
    if($tc_name!='' && $p_id!=''){
      $td_id=$dbh->sql("REPLACE INTO TRM_design_manual_test VALUES('$td_id','$tc_name','$p_id','$tc_description')");
    }
    else{
      $error = $lh->getText('Test name')." ".$lh->getText('is missing');
    }
    
    if($action!='' && $reaction!='' && $error2 == ''){
      if($should_be_neworderby == $neyorderby){
        foreach($action as $key => $value){
          $dbh->update('TRM_design_manual_commands',"orderby='$orderby[$key]', action='$value', reaction='$reaction[$key]', td_id=$td_id","ID='$key'");
        }
      }else{
        for ($i = $neyorderby; $i<$should_be_neworderby;$i++){
          $current_id = mysql_result($dbh->sql("SELECT id FROM TRM_design_manual_commands WHERE orderby=$i"), 0);
          $dbh->sql("UPDATE TRM_design_manual_commands SET orderby=$i+1 WHERE id=$current_id");
        }
        $dbh->sql("INSERT INTO TRM_design_manual_commands (id, orderby, action, reaction, td_id) VALUES ('','$neyorderby','$newaction','$newreaction', '$td_id')");
      }
      
    }
    
    if($newaction!='' && $newreaction!='' && $neyorderby !='' && $should_be_neworderby == $neyorderby){
      $dbh->sql("INSERT INTO TRM_design_manual_commands (id, orderby, action, reaction, td_id) VALUES ('','$neyorderby','$newaction','$newreaction', '$td_id')");
    }
    elseif(($newaction == "" && $newreaction!="") || ($newaction != "" && $newreaction=="")){
      $error1 = $lh->getText("Both action fields must contain text");
    }
    
if(isset($error)){
  header("Location: editTestCase.php?error=$error&td_id=new");
}
elseif(isset($error1)){
  header("Location: editTestCase.php?error=$error1&td_id=$td_id#addnew");
}
elseif(isset($error2)){
  header("Location: editTestCase.php?error=$error2&td_id=$td_id");
}
else{
  header("Location: editTestCase.php?td_id=$td_id#addnew");
}
?>
