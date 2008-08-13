<?php 
if(!file_exists('config.php')){
    header('install.php');
    exit;
}
include ('protected.php'); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php include ('header.php'); ?>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
  <?php require 'menu.php'; ?>
    <table>
      <tr>
        <th style='width: 500px;'><?php echo $lh->getText('Reqs overview'); ?></th>  
        <th></th>
        <th style='width: 500px;'><?php echo $lh->getText('Defects'); ?></th>
      </tr>
      <tr>
        <td colspan='3' style='background: rgb(211,211,211);'></td>
      </tr>
      <tr valign='top'>
      <td>
        <table width='100%'>          
        
          <?php
$p_id = $_SESSION['p_id'];
$u_id = $_SESSION['id'];
$p_name = $_SESSION['p_name'];
$useoutsidedefects = @mysql_result($dbh->select('trm_projects', "WHERE `id` = '$p_id'", '*'), 0, "outsidedefects");
if ($p_id != '') {
    echo "<tr align='left' style='background: #66CC00; color: white;'>
                        <th>" . $lh->getText('Priority') . "</th>
                        <th>" . $lh->getText('Nr') . "</th>
                        <th>" . $lh->getText('Requirement') . "</th>
                        <th>" . $lh->getText('Description') . "</th>" .
    //<th>".$lh->getText('Assigned to')."</th>
    "</tr>";
    $outer_result = $dbh->select(" 
                trm_requirements, trm_projectlist", "WHERE 
                trm_requirements.p_id=$p_id AND
                trm_projectlist.projectID=trm_requirements.p_id AND
                trm_projectlist.userID='$u_id' AND
                trm_projectlist.access='1' ORDER BY trm_requirements.priority", "*");
    $outer_num_row = mysql_numrows($outer_result);
    for ($i = 0;$i < $outer_num_row;$i++) {
        $r_id = mysql_result($outer_result, $i, "trm_requirements.ID");
        $r_nr = mysql_result($outer_result, $i, "trm_requirements.nr");
        $r_name = mysql_result($outer_result, $i, "trm_requirements.name");
        $r_priority = mysql_result($outer_result, $i, "trm_requirements.priority");
        $r_description = mysql_result($outer_result, $i, "trm_requirements.description");
        if (strlen($r_description) > 70) {
            $r_description = substr($r_description, 0, 70);
        }
        $OSBrowsAllresult = $dbh->select("trm_regsosbrows, trm_os, trm_browser", "WHERE trm_regsosbrows.r_id = '$r_id' AND trm_browser.ID=trm_regsosbrows.b_id AND trm_os.ID=trm_regsosbrows.o_id", "*");
        $OSBrowsAll = Array();
        while ($row = mysql_fetch_array($OSBrowsAllresult)) {
            $OSBrowsAll[] = $row['OSname'] . "/" . $row['browsername'];
        }
        $test_result = $dbh->select("trm_regstests", "WHERE r_id = '$r_id'", "*");
        $test_num_row = mysql_numrows($test_result);
        $r_status = 'none';
        if ($test_num_row > 0) {
            for ($b = 0;$b < $test_num_row;$b++) {
                $t_name = mysql_result($test_result, $b, "t_name");
                $inner_result = $dbh->sql("
                    SELECT * FROM trm_requirements, trm_regstests, trm_regsosbrows, trm_test, trm_os, trm_browser, trm_suite,
                    
                      (SELECT MAX(trm_suite.ID) as max_s_id FROM
                      trm_requirements, trm_regstests, trm_regsosbrows, trm_test, trm_os, trm_browser, trm_suite
                      WHERE trm_requirements.ID=$r_id AND
                      trm_regstests.t_name='$t_name' AND
                      trm_regstests.r_id=trm_requirements.id AND
                      trm_regsosbrows.r_id=trm_requirements.id AND
                      trm_test.name=trm_regstests.t_name AND
                      trm_browser.ID=trm_regsosbrows.b_id AND
                      trm_os.ID=trm_regsosbrows.o_id AND
                      trm_suite.ID=trm_test.s_id AND
                      trm_suite.analysis=1 AND
                      trm_suite.platform=trm_os.ID AND
                      trm_suite.browser=trm_browser.ID GROUP BY trm_regsosbrows.ID) trm_maxresults
                      
                    WHERE trm_requirements.ID=$r_id AND
                    trm_regstests.t_name='$t_name' AND
                    trm_regstests.r_id=trm_requirements.id AND
                    trm_regsosbrows.r_id=trm_requirements.id AND
                    trm_test.name=trm_regstests.t_name AND
                    trm_browser.ID=trm_regsosbrows.b_id AND
                    trm_os.ID=trm_regsosbrows.o_id AND
                    trm_suite.ID=trm_test.s_id AND
                    trm_suite.platform=trm_os.ID AND
                    trm_suite.ID = trm_maxresults.max_s_id AND
                    trm_suite.browser=trm_browser.ID GROUP BY trm_regsosbrows.ID");
                $num_inner_result = mysql_numrows($inner_result);
                $taken = array();
                $toPrint = array();
                for ($a = 0;$a < $num_inner_result;$a++) {
                    $inner_num_row = mysql_numrows($inner_result);
                    $t_id = mysql_result($inner_result, $a, "trm_test.ID");
                    $assignedTo = mysql_result($inner_result, $a, "trm_requirements.assigned");
                    $s_id = mysql_result($inner_result, $a, "max_s_id");
                    $t_status = mysql_result($inner_result, $a, "trm_test.status");
                    $t_manstatus = mysql_result($inner_result, $a, "trm_test.manstatus");
                    $OS = mysql_result($inner_result, $a, "trm_os.OSname");
                    $browser = mysql_result($inner_result, $a, "trm_browser.browsername");
                    if ($t_manstatus != '') {
                        $t_status = $t_manstatus;
                    }
                    if ($t_status == "passed") {
                        $OSSuccess[] = $OS;
                        $BrowSuccess[] = $browser;
                    } elseif ($t_status == "failed") {
                        $OSFailed[] = $OS;
                        $BrowFailed[] = $browser;
                    }
                    $taken[] = "$OS/$browser";
                }
                foreach($OSBrowsAll as $v) {
                    if (!in_array($v, $taken)) {
                        $t = split('/', $v);
                        $OSNotDone[] = $t[0];
                        $BrowNotDone[] = $t[1];
                    }
                }
                if (count($OSFailed) > 0) {
                    $status[] = "failed";
                } elseif (count($OSNotDone) > 0) {
                    $status[] = "notdone";
                } elseif (count($OSSuccess) > 0) {
                    $status[] = "passed";
                }
            }
            if (in_array('failed', $status)) {
                $r_status = 'failed';
            } elseif (in_array('notdone', $status)) {
                $r_status = 'notdone';
            } elseif (in_array('passed', $status)) {
                $r_status = 'passed';
            }
        }
        echo "<tr class='status_$r_status'>";
        $priority2 = str_replace(" ", "_", $r_priority);
        echo "<td><img src='img/priority$priority2.gif' alt='" . $lh->getText($r_priority) . "' title='" . $lh->getText($r_priority) . "'/></td>";
        echo "<td>$r_nr</td>";
        echo "<td><b><a href='showReqs.php#$r_id' >$r_name</a></b></td>";
        echo "<td>$r_description</td>";
        /*
        if ($assignedTo != 0){
        $assigned = mysql_result($dbh->sql("SELECT name FROM trm_users WHERE id=$assignedTo"), 0, 'name');
        echo "<td>$assigned</td>";
        }
        else{
        echo "<td></td>";
        }
        */
        echo "</tr>";
        $status = Array();
        $OSFailed = Array();
        $OSNotDone = Array();
        $OSSuccess = Array();
    }
    $bgcolor = '';
    //}
    
?>
          </table>
        </td>
        <td style='background: rgb(211,211,211); width: 2px;'></td>
        <td>
      <?php
    if ($useoutsidedefects == 0) {
        $inner = $lh->select('trm_defects, trm_type_of_defects, trm_type_of_defect_status', "
      WHERE 
      trm_type_of_defect_status.id = trm_defects.status AND
      trm_defects.p_id = $p_id AND
      trm_type_of_defects.id = trm_defects.type_of_defect AND
      trm_type_of_defect_status.priority < 3
      ORDER BY trm_type_of_defect_status.priority ASC, trm_defects.priority ASC, trm_type_of_defects.priority ASC, trm_defects.created DESC
      ", '*');
        $inner_num_row = mysql_numrows($inner);
        echo "
        <table class='collapse' width='100%'>
          <tr align='left' style='background: #66CC00; color: white;'>
            <th align='left'>" . $lh->getText('Name') . "</th>
            <th align='left'>" . $lh->getText('Type') . "</th>
            <th align='left'>" . $lh->getText('Status') . "</th>
            <th align='left'>" . $lh->getText('Priority') . "</th>
            <th align='left'>" . $lh->getText('Affected Reqs') . "</th>
          </tr>
      ";
        for ($a = 0;$a < $inner_num_row;$a++) {
            $status_short_description = mysql_result($inner, $a, "trm_type_of_defect_status.name");
            $status_imgpath = mysql_result($inner, $a, "trm_type_of_defect_status.imgpath");
            $d_id = mysql_result($inner, $a, "trm_defects.id");
            $created = mysql_result($inner, $a, "trm_defects.created");
            $createdby = mysql_result($inner, $a, "trm_defects.createdby");
            $updated = mysql_result($inner, $a, "trm_defects.updated");
            $updatedby = mysql_result($inner, $a, "trm_defects.updatedby");
            $priority = str_replace(" ", "_", mysql_result($inner, $a, "trm_defects.priority"));
            $t_id = mysql_result($inner, $a, "t_id");
            if ($t_id == NULL) {
                $t_id = 'N/A';
            } else {
                $inner2 = $lh->select('
        trm_test, trm_suite, trm_regstests, trm_requirements', "WHERE 
        trm_test.id = $t_id AND 
        trm_test.s_id = trm_suite.id AND
        trm_suite.analysis = '1'  AND
        trm_test.name = trm_regstests.t_name AND
        trm_regstests.r_id = trm_requirements.id AND
        trm_requirements.p_id = $p_id
        ", '*');
                $inner2_num_row = mysql_numrows($inner2);
                //implode(string glue, array pieces)
                for ($b = 0;$b < $inner2_num_row;$b++) {
                    $r_id = mysql_result($inner2, $b, "trm_requirements.id");
                    $r_name = mysql_result($inner2, $b, "trm_requirements.name");
                    $r_id_array[$r_id] = $r_name;
                }
            }
            /*
            $sql = $lh->select('trm_test, trm_requirements',"
            WHERE
            
            ",'*');
            */
            $type_name = mysql_result($inner, $a, "trm_type_of_defects.name");
            $type_imgpath = mysql_result($inner, $a, "trm_type_of_defects.imgpath");
            $type_of_defect = mysql_result($inner, $a, "type_of_defect");
            $defectname = mysql_result($inner, $a, "trm_defects.name");
            $description_of_defect = mysql_result($inner, $a, "description");
            //$defect_long_description = mysql_result($inner,$a,"defect_description");
            $p_id2 = mysql_result($inner, $a, "p_id");
            if ($bgcolor == 'rgb(211,211,211)') {
                $bgcolor = 'transparent';
            } else {
                $bgcolor = 'rgb(211,211,211)';
            }
            $status_short_description2 = str_replace(" ", "_", $status_short_description);
            echo "
        <tr style='background-color: $bgcolor;'>
          <td><a style='cursor: pointer;' onclick=" . '"' . "window.open('editDefectPopup.php?d_id=$d_id','mitvindue','height=750,width=620,resizable=yes,scrolling=yes');return false;" . '"' . ">" . $defectname . "</a></td>
          <td><img src='$type_imgpath' alt='$type_of_defect' />" . $lh->getText($type_name) . "</td>
          <td><img src='$status_imgpath' alt='$status_short_description' />" . $lh->getText($status_short_description) . "</td>
          <td><img src='img/priority$priority.gif' /></td>
          <td>";
            $c = 0;
            if (count($r_id_array) > 0) {
                foreach($r_id_array as $key => $value) {
                    $c++;
                    echo "<a href='showFullReqs.php?reqID=$key'>$value</a>";
                    if ($c != count($r_id_array)) {
                        echo ", ";
                    }
                }
            } else {
                echo "N/A";
            }
            $r_id_array = array();
            echo "</td>";
            echo "</tr>";
        }
    } else {
        echo "<br /><center><a class='full' href='" . mysql_result($dbh->select('trm_projects', "WHERE `id` = '$p_id'", '*'), 0, "viewdefectsurl") . "' name='menulink'> " . $lh->getText('Show defects') . " </a></center>";
    }
    echo "</table>";
?>
      </td>
    </tr>
    <tr>
      <td colspan='3' style='background: rgb(211,211,211);'></td>
    </tr>
    <tr>
      <td>
      <?php
    /*
    $proResult = $dbh->sql("SELECT * FROM trm_projects  WHERE trm_projects.assigned = $u_id");
    
    echo "<h3>".$dbh->getText("Projects")."</h3>";
    echo "<table class='collapse' width='100%'>
    <tr align='left' style='background: #66CC00; color: white;'>
    <th align='left'>".$lh->getText('Name')."</th>
    <th align='left'>".$lh->getText('Description')."</th>
    </tr>";
    $numproResult=mysql_numrows($proResult);
    
    //implode(string glue, array pieces)
    for ($b = 0; $b<$numproResult; $b++){
    echo "<tr><td>";
    echo mysql_result($proResult,$b,"trm_projects.name");
    echo "</td><td>";
    echo mysql_result($proResult,$b,"trm_projects.description");
    echo "</td></tr>";
    }
    
    
    */
?>
      
      </td>
    </tr>
    </table>
  <?php
} else {
    echo "<h1>" . $lh->getText('Choose project') . "</h1>";
} ?>
  </body>
</html>
