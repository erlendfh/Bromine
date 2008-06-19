<?php include ('protected.php'); ?>
<?php
//print_r($GLOBALS['_POST']);
/*
Array
(
[t_id] => Array
(
[0] => 1
[1] => 3
)

[typename] => Array
(
[0] => rc-php
[1] => rc-ruby
)

[newtypename] =>
[b_id] => Array
(
[0] => 1
[1] => 2
[2] => 3
[3] => 11
[4] => 10
[5] => 13
[6] => 14
)

[browsername] => Array
(
[0] => IE7
[1] => IE6
[2] => Firefox
[3] => IEhta
[4] => Chrome
[5] => Safari
[6] => pifirefox
)

[newbrowsername] =>
[o_id] => Array
(
[0] => 1
[1] => 2
[2] => 3
[3] => 4
[4] => 5
[5] => 6
[6] => 12
)

[OSname] => Array
(
[0] => Vista
[1] => Linux
[2] => 2000
[3] => os x
[4] => 98
[5] => 95
[6] => XP
)

[newOSname] =>
[guestname] => guest
[guestpass] => guest
[ut_id] => Array
(
[0] => 1
[1] => 2
[2] => 3
[3] => 4
[4] => 5
[5] => 6
[6] => 7
[7] => 9
)

[utname] => Array
(
[0] => inactive
[1] => robot
[2] => admin
[3] => manager
[4] => tester
[5] => supertester
[6] => guest
[7] => drift
)

[newutname] =>
[s_id] => Array
(
[0] => 66
[1] => 78
[2] => 37
[3] => 55
[4] => 71
[5] => 7
[6] => 86
[7] => 38
[8] => 92
[9] => 58
[10] => 73
[11] => 2
[12] => 39
[13] => 40
[14] => 24
[15] => 63
[16] => 41
[17] => 70
[18] => 85
[19] => 65
[20] => 50
[21] => 42
[22] => 91
[23] => 14
[24] => 15
[25] => 18
[26] => 83
[27] => 84
[28] => 79
[29] => 19
[30] => 20
[31] => 49
[32] => 53
[33] => 75
[34] => 93
[35] => 44
[36] => 74
[37] => 29
[38] => 82
[39] => 43
[40] => 59
[41] => 30
[42] => 67
[43] => 45
[44] => 87
[45] => 88
[46] => 51
[47] => 46
[48] => 72
[49] => 68
[50] => 32
[51] => 64
[52] => 89
[53] => 61
[54] => 62
[55] => 34
[56] => 54
[57] => 90
)

[sitename] => Array
(
[0] => TRMindex.php
[1] => addComment.php
[2] => adminSubMenu.php
[3] => adminindex.php
[4] => analysis.php
[5] => corerunner.php
[6] => createManSuite.php
[7] => delete.php
[8] => editCoreSuites.php
[9] => editCron.php
[10] => editDefectPopup.php
[11] => editHR.php
[12] => editMisc.php
[13] => editNodes.php
[14] => editProjects.php
[15] => editRequirements.php
[16] => editSites.php
[17] => editTest.php
[18] => editTestCase.php
[19] => editTestPlan.php
[20] => editUserTypeAccess.php
[21] => editUsers.php
[22] => genericRunner.php
[23] => header.php
[24] => index.php
[25] => main.php
[26] => manualControl.php
[27] => manualRunner.php
[28] => manualtest.php
[29] => menu.php
[30] => noderunner.php
[31] => projectsSubMenu.php
[32] => projectsindex.php
[33] => saveComment.php
[34] => saveCoreSuites.php
[35] => saveCron.php
[36] => saveDefect.php
[37] => saveHR.php
[38] => saveManStatus.php
[39] => saveMisc.php
[40] => saveNodes.php
[41] => saveProjects.php
[42] => saveRequirements.php
[43] => saveSites.php
[44] => saveTestCase.php
[45] => saveTestPlan.php
[46] => saveUserTypeAccess.php
[47] => saveUsers.php
[48] => showDefects.php
[49] => showFullReqs.php
[50] => showReport.php
[51] => showReqs.php
[52] => simpleFTP.php
[53] => statusRC.php
[54] => testRunnerRC.php
[55] => testlabSubMenu.php
[56] => testlabindex.php
[57] => uploader.php
)

[description] => Array
(
[0] => TRM index page
[1] => Add a comment to anything
[2] => Admin submenu
[3] => Admin index page
[4] => Shows the suites marked for analysis
[5] => Runs core tests33
[6] =>
[7] => Handles all deletes
[8] =>
[9] => Plan tests to run in the future. Warning!! Dangerous. Can plan ANYTHING!!
[10] => Shows a single defect in a popup window
[11] => Assing people to projects
[12] => Edit misc. info
[13] => Edit nodes (location/browsers etc.)
[14] => Create/Edit projects
[15] => Edit the requirements
[16] => Edit core sites (TR path etc.)
[17] => properties for a single test
[18] =>
[19] => Assign tests to projects
[20] => Edit usertype access
[21] => Edit/add users
[22] =>
[23] => Included in most files, include copyright and language handler
[24] => First page to hit
[25] => Shows suite results
[26] =>
[27] =>
[28] =>
[29] => The brightly colored menu
[30] => Runs node tests
[31] => Projects sub menu
[32] => Projects index page
[33] => Saves comments
[34] =>
[35] => Saves the crontab
[36] => Gemmer/Opdaterer defects
[37] => Save people/project assignments
[38] =>
[39] => Saves misc data
[40] => Saves node data
[41] => Saves projects data
[42] => Saves requirements
[43] => Saves core sites data
[44] => Save testcases
[45] => Saves testplan
[46] => Save usertype acccess data
[47] => Save user data
[48] => Show all defects
[49] => Show a single requirement styled for printing
[50] => Shows the results of a single sutie
[51] => Show all requirements
[52] =>
[53] => Shows the status of the running RC test
[54] => Runs RC tests
[55] => Test lab sub menu
[56] => Index page for the test lab
[57] =>
)

[newsitename] =>
[newdescription] =>
[v_id] => Array
(
[0] => 1
)

[value] => Array
(
[0] => 0
)

[tod_id] => Array
(
[0] => 2
[1] => 6
[2] => 1
[3] => 5
[4] => 7
)

[type_priority] => Array
(
[0] => 4
[1] => 3
[2] => 0
[3] => 1
[4] => 2
)

[type_imgpath] => Array
(
[0] => img/testerror.png
[1] => img/request.png
[2] => img/functionality.png
[3] => img/layout.png
[4] => img/data.png
)

[tods_id] => Array
(
[0] => 4
[1] => 1
[2] => 2
[3] => 3
[4] => 42
)

[status_priority] => Array
(
[0] => 4
[1] => 0
[2] => 2
[3] => 3
[4] => 1
)

[] => Array
(
[0] => img/rejected.png
[1] => img/open.png
[2] => img/inprogress.png
[3] => img/resolved.png
[4] => img/readyfortest.png
)

)
*/
$t_id = $_POST['t_id'];
$typename = $_POST['typename'];
$newtypename = $_POST['newtypename'];
$b_id = $_POST['b_id'];
$browsername = $_POST['browsername'];
$newbrowsername = $_POST['newbrowsername'];
$o_id = $_POST['o_id'];
$OSname = $_POST['OSname'];
$newOSname = $_POST['newOSname'];
$guestname = $_POST['guestname'];
$guestpass = $_POST['guestpass'];
$s_id = $_POST['s_id'];
$sitename = $_POST['sitename'];
$description = $_POST['description'];
$newsitename = $_POST['newsitename'];
$newdescription = $_POST['newdescription'];
$ut_id = $_POST['ut_id'];
$utname = $_POST['utname'];
$newutname = $_POST['newutname'];
$v_id = $_POST['v_id'];
$value = $_POST['value'];
$tod_id = $_POST['tod_id'];
$type_priority = $_POST['type_priority'];
$type_imgpath = $_POST['type_imgpath'];
$tods_id = $_POST['tods_id'];
$status_priority = $_POST['status_priority'];
$status_imgpath = $_POST['status_imgpath'];
$dms_useoutside = $_POST['dms_useoutside'];
$dms_viewurl = $_POST['dms_viewurl'];
$dms_addurl = $_POST['dms_addurl'];
//defect type updater
for ($i = 0;$i < count($tod_id);$i++) {
    $dbh->update('TRM_type_of_defects', "priority = '$type_priority[$i]', imgpath='$type_imgpath[$i]'", "ID = '$tod_id[$i]'");
}
//defect status updater
for ($i = 0;$i < count($tods_id);$i++) {
    $dbh->update('TRM_type_of_defect_status', "priority = '$status_priority[$i]', imgpath='$status_imgpath[$i]'", "ID = '$tods_id[$i]'");
}
//CONFIG UPDATER
for ($i = 0;$i < count($v_id);$i++) {
    $dbh->update('TRM_config', "value = '$value[$i]'", "ID = '$v_id[$i]'");
}
//USERTYPE UPDATER
for ($i = 0;$i < count($ut_id);$i++) {
    $dbh->update('TRM_usertypes', "name = '$utname[$i]'", "ID = '$ut_id[$i]'");
}
//USERTYPE INSERTER
if (strlen($newutname) > 0) {
    $newut_id = $dbh->insert('TRM_usertypes', "NULL,'$newutname'", 'ID, name');
    $result = $dbh->select('TRM_sites', '', '*');
    $num = mysql_numrows($result);
    for ($i = 0;$i < $num;$i++) {
        $ts_id = mysql_result($result, $i, "ID");
        $dbh->insert('TRM_usertype_access', "NULL,'$newut_id','$ts_id', '0'", 'ID, ut_id, s_id, access');
    }
}
//TYPE UPDATER
for ($i = 0;$i < count($t_id);$i++) {
    $dbh->update('TRM_types', "typename = '$typename[$i]'", "ID = '$t_id[$i]'");
}
//TYPE INSERTER
if (strlen($newtypename) > 0) {
    $dbh->insert('TRM_types', "NULL,'$newtypename'", 'ID, typename');
}
//BROWSER UPDATER
for ($i = 0;$i < count($b_id);$i++) {
    $dbh->update('TRM_browser', "browsername = '$browsername[$i]'", "ID = '$b_id[$i]'");
}
//BROWSER INSERTER
if (strlen($newbrowsername) > 0) {
    $dbh->insert('TRM_browser', "NULL,'$newbrowsername'", 'ID, browsername');
}
//OS UPDATER
for ($i = 0;$i < count($o_id);$i++) {
    $dbh->update('TRM_OS', "OSname = '$OSname[$i]'", "ID = '$o_id[$i]'");
}
//OS INSERTER
if (strlen($newOSname) > 0) {
    $dbh->insert('TRM_OS', "NULL,'$newOSname'", 'ID, OSname');
}
//GUEST UPDATER
if (strlen($guestname) > 0 && strlen($guestpass) > 0) {
    $dbh->update('TRM_users', "name = '$guestname', password='$guestpass'", "ID = 1");
}
//SITE UPDATER
for ($i = 0;$i < count($s_id);$i++) {
    $dbh->update('TRM_sites', "sitename = '$sitename[$i]', description = '$description[$i]'", "ID = '$s_id[$i]'");
}
//SITE INSERTER
if (strlen($newsitename) > 0) {
    $s_id = $dbh->insert('TRM_sites', "NULL,'$newsitename', '$newdescription'", 'ID, sitename, description');
    $result = $dbh->select('TRM_usertypes', '', '*');
    $num = mysql_numrows($result);
    for ($i = 0;$i < $num;$i++) {
        $ut_id = mysql_result($result, $i, "ID");
        $dbh->insert('TRM_usertype_access', "NULL,'$ut_id','$s_id', '0'", 'ID, ut_id, s_id, access');
    }
}
//DEFECT MANAGEMENT SYSTEM INFO
if (is_numeric($dms_useoutside)) {
    $dbh->update('TRM_defect_management', "`value`='$dms_useoutside'", "`key` = 'useoutside'");
}
$dbh->update('TRM_defect_management', "`value`='$dms_viewurl'", "`key` = 'viewurl'");
$dbh->update('TRM_defect_management', "`value`='$dms_addurl'", "`key` = 'addurl'");
header("Location: editMisc.php");
?>
