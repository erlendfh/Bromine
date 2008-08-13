<?php include_once ('protected.php') ?>
<?php
$back = $_GET['back'];
$type = $_GET['type'];
$id = $_GET['id'];

function deletetestCase($id) {
    global $dbh;
    $dbh->delete("trm_reqstests USING trm_design_manual_test, trm_reqstests", "
    trm_design_manual_test.id=$id AND
    trm_design_manual_test.name=trm_reqstests.t_name");
    $dbh->delete("trm_design_manual_test", "ID=$id");
    $dbh->delete("trm_design_manual_commands", "td_id=$id");
}
function deleteattachment($id) {
    global $dbh;
    $attachment = $_GET['attachment'];
    $dbh->delete("trm_defect_has_attachment", "id=$id");
    unlink($attachment);
}
function deletetestCaseStep($id) {
    global $dbh;
    $dbh->delete("trm_design_manual_commands", "ID=$id");
}
function deleteprojects_has_sites($id) {
    global $dbh;
    $dbh->delete("trm_projects_has_sites", "ID=$id");
}
function deletedefect($id) {
    global $dbh, $back, $returnTo;
    $b = split(',', $back);
    $t_id = $b[0];
    $s_id = $b[1];
    $back = "editComments.php?id=$t_id&s_id=$s_id";
    $dbh->update("trm_defects", "is_deleted=1", "ID=$id");
}
function deletesuite($id) {
    global $dbh;
    $dbh->delete("trm_commands
                  USING
                  trm_test,
                  trm_commands", "trm_test.s_id=$id AND 
                   trm_commands.t_id=trm_test.ID
                  ");
    $dbh->delete("trm_test", "s_id=$id");
    $dbh->delete("trm_suite", "ID=$id");
}
function deleteproject($id) {
    global $dbh;
    $result = $dbh->select('trm_suite', "WHERE p_id=$id", 'ID');
    $num = mysql_num_rows($result);
    for ($u = 0;$u < $num;$u++) {
        $sid = mysql_result($result, $u, 'ID');
        deletesuite($sid);
    }
    $result = $dbh->select('trm_requirements', "WHERE p_id=$id", 'ID');
    $num = mysql_num_rows($result);
    for ($u = 0;$u < $num;$u++) {
        $rid = mysql_result($result, $u, 'ID');
        deleterequirement($rid);
    }
    $dbh->delete("trm_projects", "ID=$id");
    $dbh->delete("trm_core", "p_id=$id");
    $dbh->delete("trm_core_testsuites", "p_id=$id");
    //$dbh->delete("trm_nodes_testsuites","p_id=$id");
    $dbh->delete("trm_projectlist", "projectID=$id");
}
function deleteuser($id) {
    global $dbh;
    $dbh->delete("trm_users", "ID=$id");
    $dbh->delete("trm_projectlist", "userID=$id");
}
function deletenodetest($id) {
    global $dbh;
    $dbh->delete("trm_nodes_testsuites", "ID=$id");
}
function deletecoretest($id) {
    global $dbh;
    $dbh->delete("trm_core_testsuites", "ID=$id");
}
function deleterequirement($id) {
    global $dbh;
    $dbh->delete("trm_requirements", "ID=$id");
    $dbh->delete("trm_reqstests", "r_id=$id");
    $dbh->delete("trm_regsosbrows", "r_id=$id");
}
function deletecore($id) {
    global $dbh;
    $dbh->delete("trm_core", "ID=$id");
}
function deletenode($id) {
    global $dbh;
    $dbh->delete("trm_nodes", "ID=$id");
    $dbh->delete("trm_nodes_browsers", "n_id=$id");
    //$dbh->delete("trm_nodes_testsuites","n_id=$id");
    
}
function deletetype($id) {
    global $dbh;
    $dbh->delete("trm_types", "ID=$id");
}
function deletebrowser($id) {
    global $dbh;
    $dbh->delete("trm_browser", "ID=$id");
}
function deleteOS($id) {
    global $dbh;
    $dbh->delete("trm_os", "ID=$id");
}
function deletesite($id) {
    global $dbh;
    $dbh->delete("trm_sites", "ID=$id");
    $dbh->delete("trm_usertype_access", "s_id=$id");
}
function deleteusertype($id) {
    global $dbh;
    $dbh->delete("trm_usertypes", "ID=$id");
    $dbh->delete("trm_usertype_access", "ut_id=$id");
}
function deleteReqsTest($id) {
    global $dbh;
    $dbh->delete("trm_reqstests", "ID=$id");
}
function deleteOSBrows($id) {
    global $dbh;
    $dbh->delete("trm_regsosbrows", "ID=$id");
}
function deleteDatafile($id){
    $id = str_replace("..", "", $id);
    unlink("$id");
}

$code = "delete$type('$id');";
$error = true;
switch ($type) {
    case 'attachment':
        if ($_SESSION['usertype'] == 3) {
            eval($code);
            $error = false;
        }
    break;
    case 'Datafile':
        if ($_SESSION['usertype'] == 3 || $_SESSION['usertype'] == 6 || $_SESSION['usertype'] == 5) {
            eval($code);
            $error = false;
        }
    break;
    case 'suite':
        if ($_SESSION['usertype'] == 3 || $_SESSION['usertype'] == 6) {
            eval($code);
            $error = false;
        }
    break;
    case 'project':
        if ($_SESSION['usertype'] == 3) {
            eval($code);
            $error = false;
        }
    break;
    case 'user':
        if ($_SESSION['usertype'] == 3) {
            eval($code);
            $error = false;
        }
    break;
    case 'requirement':
        if ($_SESSION['usertype'] == 3 || $_SESSION['usertype'] == 4) {
            eval($code);
            $error = false;
        }
    break;
    case 'nodetest':
        if ($_SESSION['usertype'] == 3 || $_SESSION['usertype'] == 6 || $_SESSION['usertype'] == 5) {
            eval($code);
            $error = false;
        }
    break;
    case 'coretest':
        if ($_SESSION['usertype'] == 3 || $_SESSION['usertype'] == 6 || $_SESSION['usertype'] == 5 || $_SESSION['usertype'] == 4) {
            eval($code);
            $error = false;
        }
    break;
    case 'core':
        if ($_SESSION['usertype'] == 3) {
            eval($code);
            $error = false;
        }
    break;
    case 'node':
        if ($_SESSION['usertype'] == 3) {
            eval($code);
            $error = false;
        }
    break;
    case 'type':
        if ($_SESSION['usertype'] == 3) {
            eval($code);
            $error = false;
        }
    break;
    case 'browser':
        if ($_SESSION['usertype'] == 3) {
            eval($code);
            $error = false;
        }
    break;
    case 'OS':
        if ($_SESSION['usertype'] == 3) {
            eval($code);
            $error = false;
        }
    break;
    case 'site':
        if ($_SESSION['usertype'] == 3) {
            eval($code);
            $error = false;
        }
    break;
    case 'usertype':
        if ($_SESSION['usertype'] == 3) {
            eval($code);
            $error = false;
        }
    break;
    case 'ReqsTest':
        if ($_SESSION['usertype'] == 3 || $_SESSION['usertype'] == 4) {
            eval($code);
            $error = false;
        }
    break;
    case 'OSBrows':
        if ($_SESSION['usertype'] == 3 || $_SESSION['usertype'] == 4) {
            eval($code);
            $error = false;
        }
    break;
    case 'defect':
        if ($_SESSION['usertype'] == 3) {
            eval($code);
            $error = false;
        }
    break;
    case 'projects_has_sites':
        if ($_SESSION['usertype'] == 3 || $_SESSION['usertype'] == 4) {
            eval($code);
            $error = false;
        }
    break;
    case 'testCase':
        if ($_SESSION['usertype'] == 3 || $_SESSION['usertype'] == 4) {
            eval($code);
            $error = false;
        }
    break;
    case 'testCaseStep':
        if ($_SESSION['usertype'] == 3 || $_SESSION['usertype'] == 4) {
            eval($code);
            $error = false;
        }
    break;
    default:
}
if ($error) {
    $noaccess = $dbh->getText('No access');
    if (strpos($back, '?') !== FALSE) {
        header("Location: $back&errormsg=$noaccess");
    } else {
        header("Location: $back?errormsg=$noaccess");
    }
} else {
    header("Location: $back");
}
?>
