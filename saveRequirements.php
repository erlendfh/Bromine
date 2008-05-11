<?php
  include_once('protected.php');
  include_once('DBHandler.class.php');
  $dbh= new DBHandler($_SESSION['lang']);
  $in =$GLOBALS['_POST'];
  //print_r($in);
  /*
  Array
(
    [id] => Array
        (
            [0] => 7
            [1] => 6
        )
    [nr] => Array
        (
            [0] => kk1
            [1] => kk2
        )
    [name] => Array
        (
            [0] => person
            [1] => kort
        )
    [description] => Array
        (
            [0] => man skal kunne finde personer
            [1] => skal kunne vise kort
        )
    [OS] => Array
        (
            [7] => 2000
            [6] => os x
        )
    [browser] => Array
        (
            [7] => Firefox
            [6] => IE6
        )
    [OSnew] => Array
        (
            [7] => Vista
            [6] => Vista
        )
    [browsernew] => Array
        (
            [7] => IE7
            [6] => IE7
        )
    [browsernew2] => IE7
    [OSnew2] => Vista
)
 
*/
$id = $in['id'];
$nr = $in['nr'];
$name = $in['name'];
$description = $in['description'];
$assigned = $in['assigned'];
$OS = $in['OS'];
$browser = $in['browser'];
$OSnew = $in['OSnew'];
$browsernew = $in['browsernew'];
$browsernew2 = $in['browsernew2'];
$OSnew2 = $in['OSnew2'];
$newnr2 = $in['newnr2'];
$newname2 = $in['newname2'];
$newdescription2 = $in['newdescription2'];
$newassigned = $in['newassigned'];
$p_id = $in['p_id'];
$author = $in['author'];
$priority= $in['priority2'];
$ReqsOSBrows = $in['ReqsOSBrows'];
$changePriority = $in['changePriority'];

for ($i = 0;$i<count($id);$i++){
      $dbh->update('TRM_requirements',
      "name = '$name[$i]',
      description = '$description[$i]',
      nr = '$nr[$i]',
      assigned = '$assigned[$i]',
      priority = '$changePriority[$i]'
      ",
      "ID = '$id[$i]'");
}

$a=0;

if(count($id)>0){
  foreach ($id as $key => $value) {
    for ($i = 0;$i<count($OS[$value]);$i++){
      $dbh->update('TRM_ReqsOSBrows',"b_id = ".$browser[$value][$i].", o_id = ".$OS[$value][$i],"ID = ".$ReqsOSBrows[$a]);
      $a++;
    }
  }
}
//ID 	b_id 	o_id 	r_id
if($OSnew!='' && $browsernew!=''){
  foreach ($OSnew as $key => $value) {
    $newOS = $value;
    $newBrow = $browsernew[$key];
    
    if ($newOS != '' && $newBrow != ''){
      $does_exist = mysql_num_rows($dbh->sql("SELECT * FROM TRM_ReqsOSBrows WHERE b_id = $newBrow AND o_id = $newOS AND r_id = $key"));
      if ($does_exist == 0){
        $dbh->insert('TRM_ReqsOSBrows',"'','$newBrow','$newOS','$key'","ID, b_id, o_id, r_id");
      }else{
        $error .= $dbh->getText('OS-browser combi already exist');
      }
    }
  }
}
if ($newnr2 == '' && ($newname2 != '' && $newdescription2 != '')){$error .= "Krav Nr må ikke være tomt";} 
if ($newname2 == '' && ($newnr2 != '' && $newdescription2 != '')){$error .= "Krav navn må ikke være tomt";} 
if ($newdescription2 == '' && ($newname2 != '' && $newnr2 != '')){$error .= "Krav beskrivelse må ikke være tom";} 

if ($newnr2 != '' && $newname2 != '' && $newdescription2 != ''){
  $does_exist = mysql_num_rows($dbh->sql("SELECT * FROM TRM_requirements WHERE nr = '$newnr2' AND p_id=$p_id"));
  if ($does_exist == 0){
    $r_id=$dbh->insert('TRM_requirements',"
    '',
    '$newname2',
    '$newdescription2',
    '$p_id',
    '$newnr2',
    '$author',
    '$priority',
    '$newassigned'
    ","ID, name, description, p_id, nr, author, priority, assigned");
    $dbh->insert('TRM_ReqsOSBrows',"'','$browsernew2','$OSnew2','$r_id'","ID, b_id, o_id, r_id");
  }else{
    $error .= $dbh->getText('Req with same nr exist');
  }
}
if (isset($error)){
  header("Location: editRequirements.php?error=$error#error");
}else{
  header("Location: editRequirements.php#$newnr2");
}

?>
