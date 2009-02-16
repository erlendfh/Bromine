<?php
include_once ('protected.php');
$in = $GLOBALS['_POST'];
//print_r($in);
/*
Array
(
[td_id] => 1
[tc_name] => Min første manuelle test i Bromine
[action] => Array
(
[1] => Åben http://www.krak.dk
[2] => klik på firma-fanen
[3] => Søg på vvs i firmasøgning
[4] => Blow me
[5] => Blow me
)

[reaction] => Array
(
[1] => Krak.dk åbner som den skal!
[2] => Se at den åbner som den skal
[3] => Se at resultat sider hvis firmaer der har noget med VVS at gøre
[4] => YES SIR!
[5] => YES SIR!
)

[newaction] => ny aktion
[newreaction] => ny reaktion
)
*/
$p_id = $_SESSION['p_id'];
$p_name = $_SESSION['p_name'];
$td_id = $in['td_id'];
$tc_description = $in['tc_description'];
if ($td_id == 'new') {
    $td_id = '';
}
$tc_name = $in['tc_name'];
$tc_name = strtolower(str_replace(' ', '_', $tc_name));
$ugly = array('!', ',', '.', '-', '"', "'", '#', '€', '%', '&', '/', '(', ')', '=', '?', '`', '@', '£', '$', '', '{', '[', ']', '}', '+', '|', '<', '>', '*', '^', '~', 'š', '\\', 'æ', 'ø', 'å', 'Æ', 'Ø', 'Å');
$tc_name = str_replace($ugly, '', $tc_name);
$newtest = $in['newtest'];
$action = $in['action'];
$orderby = $in['orderby'];
$reaction = $in['reaction'];
$newaction = $in['newaction'];
$newreaction = $in['newreaction'];
$neyorderby = $in['neworderby'];
$should_be_neworderby = $in['should_be_neworderby'];
if (is_array($orderby)) {
    $result = array_unique($orderby);
    if (count($result) != count($orderby)) {
        $error2 = $lh->getText('Det er nogo at have to af de samme orderby!');
    }
}
if ($tc_name != '' && $p_id != '') {
    $oldNameResult = $dbh->select('trm_design_manual_test', "WHERE ID='$td_id'", '*');
    while ($row = mysql_fetch_array($oldNameResult)) {
        $oldName = $row['name'];
    }
    $td_id = $dbh->sql("REPLACE INTO trm_design_manual_test VALUES('$td_id','$tc_name','$p_id','$tc_description')");
    $dbh->sql("UPDATE trm_reqstests SET t_name='$tc_name' WHERE t_name='$oldName'"); //Hmmmm.... Not the best solution
    $typeresult = $dbh->select('trm_types', '', '*');
    while ($row = mysql_fetch_array($typeresult)) {
        $id = $row['ID']; 
        $types_id[] = $id;
        $types[$id] = $row['typename'];
        $exts[$id] = $row['extension'];
    }
    foreach($types_id as $id){  
        $type=$types[$id];
        $ext=$exts[$id];
        if($oldName!='' && file_exists("RC/$type/$p_name/$oldName.$ext")){
            rename("RC/$type/$p_name/$oldName.$ext","RC/$type/$p_name/$tc_name.$ext");   
        }
    }
} else {
    $error = $lh->getText('Test name') . " " . $lh->getText('is missing');
}
if ($action != '' && $reaction != '' && $error2 == '') {
    if ($should_be_neworderby == $neyorderby) {
        foreach($action as $key => $value) {
            $dbh->update('trm_design_manual_commands', "orderby='$orderby[$key]', action='$value', reaction='$reaction[$key]', td_id=$td_id", "ID='$key'");
        }
    } else {
        for ($i = $neyorderby;$i < $should_be_neworderby;$i++) {
            $current_id = mysql_result($dbh->sql("SELECT id FROM trm_design_manual_commands WHERE orderby=$i"), 0);
            $dbh->sql("UPDATE trm_design_manual_commands SET orderby=$i+1 WHERE id=$current_id");
        }
        $dbh->sql("INSERT INTO trm_design_manual_commands (id, orderby, action, reaction, td_id) VALUES (NULL,'$neyorderby','$newaction','$newreaction', '$td_id')");
    }
}
if ($newaction != '' && $newreaction != '' && $neyorderby != '' && $should_be_neworderby == $neyorderby) {
    $dbh->sql("INSERT INTO trm_design_manual_commands (id, orderby, action, reaction, td_id) VALUES (NULL,'$neyorderby','$newaction','$newreaction', '$td_id')");
} elseif (($newaction == "" && $newreaction != "") || ($newaction != "" && $newreaction == "")) {
    $error1 = $lh->getText("Both action fields must contain text");
}
if (isset($error)) {
    header("Location: editTestCase.php?error=$error&td_id=new");
} elseif (isset($error1)) {
    header("Location: editTestCase.php?error=$error1&td_id=$td_id#addnew");
} elseif (isset($error2)) {
    header("Location: editTestCase.php?error=$error2&td_id=$td_id");
} else {
    header("Location: editTestCase.php?td_id=$td_id#addnew");
}
?>
