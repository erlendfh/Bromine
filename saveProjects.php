<?php include ('protected.php'); ?>
<?php
$dbh = new DBHandler($_SESSION['lang']);
$p_id = $_POST['p_id'];
$name = $_POST['name'];
$description = $_POST['description'];
$assigned = $_POST['assigned'];
$newname = $_POST['newname'];
if (strpbrk($newname, '\\/:?"*<>|') != false) {
    $error = $lh->getText("Name contains illegal characters");
    header("Location: editProjects.php?error=$error#error");
    break;
}
$newdescription = $_POST['newdescription'];
$newassigned = $_POST['newassigned'];
$sitetotest = $_POST['sitetotest'];
$sitetotestnew = $_POST['sitetotestnew'];
$num = count($p_id);
for ($i = 0;$i < $num;$i++) {
    $oldname = mysql_result($dbh->select('TRM_projects', "WHERE ID='$p_id[$i]'", 'name'), 0, 'name');
    $dbh->update('TRM_projects', "name='$name[$i]',
    description='$description[$i]',
    assigned='$assigned[$i]'", "ID='$p_id[$i]'");
    if ($oldname != $name[$i]) {
        $typeresult = $dbh->select('TRM_types', '', 'typename');
        $typenum = mysql_num_rows($typeresult);
        for ($a = 0;$a < $typenum;$a++) {
            $typename = mysql_result($typeresult, $a, 'typename');
            rename("RC/$typename/$oldname", "RC/$typename/$name[$i]");
        }
    }
}
if (!is_array($sitetotest)) {
    $sitetotest = array($sitetotest);
}
foreach($sitetotest as $key => $value) {
    $dbh->update('TRM_projects_has_sites', "sitetotest='$value'", "ID=$key");
}
if (!is_array($sitetotestnew)) {
    $sitetotestnew = array($sitetotestnew);
}
foreach($sitetotestnew as $key => $value) {
    if ($value != '') {
        $dbh->insert('TRM_projects_has_sites', "NULL,'$key', '$value'", 'ID, p_id, sitetotest');
    }
}
if (strlen($newname) > 0 && strlen($newdescription) == 0) {
    $error = $dbh->getText('Description') . " " . $dbh->getText('is missing');
} elseif (strlen($newname) == 0 && $newdescription > 0) {
    $error = $dbh->getText('Name') . " " . $dbh->getText('is missing');
} elseif (strlen($newname) > 0 && strlen($newdescription) > 0) {
    $doesexist = mysql_num_rows($dbh->select('TRM_projects', "WHERE name = '$newname'", 'name'));
    if ($doesexist == 0) {
        $np_id = $dbh->insert('TRM_projects', "NULL,'$newname', '$newdescription', '$newassigned'", 'ID, name, description, assigned');
        $typeresult = $dbh->select('TRM_types', '', 'typename');
        $typenum = mysql_num_rows($typeresult);
        for ($i = 0;$i < $typenum;$i++) {
            $typename = mysql_result($typeresult, $i, 'typename');
            @mkdir("RC/$typename/$newname");
            @chmod("RC/$typename/$newname", 0777);
            @mkdir("RC/$typename/$newname/ss");
            @chmod("RC/$typename/$newname/ss", 0777);
            @mkdir("RC/$typename/$newname/data");
            @chmod("RC/$typename/$newname/data", 0777);
        }
    } else {
        $error = $lh->getText('Same project name error');
    }
    $result = $dbh->select('TRM_users', '', 'ID');
    $num = mysql_num_rows($result);
    for ($i = 0;$i < $num;$i++) {
        $id = mysql_result($result, $i, 'ID');
        $dbh->insert('TRM_projectList', "NULL,'$id','$np_id','0'", 'id, userID, projectID, access');
    }
}
if (isset($error)) {
    header("Location: editProjects.php?error=$error#error");
} else {
    header("Location: editProjects.php#$np_id");
}
?>
