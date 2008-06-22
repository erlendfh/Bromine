<?php include ('protected.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php include ('header.php'); ?>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script type="text/javaScript" src="js/popup.js"></script>
  </head>
  <body>
  <?php 
include ('menu.php');
    $submenu = new BromineSubmenu();
    $submenu->testResultManager();
    $submenu->display();
?>
  <div id="object1" style="position:absolute; background-color:#FFFFDD;color:black;border-color:black;border-width:20px; visibility:visible; left:25px; top:-100px; z-index:1" onmouseover="Popup.over()" onmouseout="Popup.out()">
    pop up description layer
  </div>
    <?php
function getNameFromID($id) {
    global $lh;
    $result = $lh->select('TRM_users', "WHERE id=$id", 'name');
    return mysql_result($result, 0, "name");
}
$p_id = $_SESSION['p_id'];
if ($p_id != '') {
    echo "<div><button onclick=" . '"' . "window.open('editDefectPopup.php','mitvindue','height=750,width=620,resizable=no,scrolling=yes');return false;" . '"' . ">" . $lh->getText('Add defect') . "</button></div>";
    $inner = $lh->select('TRM_defects, TRM_type_of_defects, TRM_type_of_defect_status', "
      WHERE 
      TRM_type_of_defect_status.id = TRM_defects.status AND
      TRM_defects.p_id = $p_id AND
      TRM_type_of_defects.id = TRM_defects.type_of_defect
      ORDER BY TRM_type_of_defect_status.priority ASC, TRM_defects.priority, TRM_type_of_defects.priority ASC, TRM_defects.created DESC
      ", '*');
    $inner_num_row = mysql_numrows($inner);
    echo "
        <table class='collapse'>
          <tr>
          <th align='left'>" . $lh->getText('Created') . "</th>
          <th align='left'>" . $lh->getText('Created by') . "</th>
          <th align='left'>" . $lh->getText('Last updated') . "</th>
          <th align='left'>" . $lh->getText('Updated by') . "</th>
          <th align='left'>" . $lh->getText('Name') . "</th>
          <th align='left'>" . $lh->getText('Priority') . "</th>
          <th align='left'>" . $lh->getText('Type') . "</th>
          <th align='left'>" . $lh->getText('Description') . "</th>
          <th align='left'>" . $lh->getText('Test') . "</th>
          <th align='left'>" . $lh->getText('Affected Reqs') . "</th>
          <th align='left'></th>
          </tr>
      ";
    for ($a = 0;$a < $inner_num_row;$a++) {
        $status_short_description = mysql_result($inner, $a, "TRM_type_of_defect_status.name");
        $status_imgpath = mysql_result($inner, $a, "TRM_type_of_defect_status.imgpath");
        $d_id = mysql_result($inner, $a, "TRM_defects.id");
        $created = mysql_result($inner, $a, "TRM_defects.created");
        $createdby = mysql_result($inner, $a, "TRM_defects.createdby");
        $updated = mysql_result($inner, $a, "TRM_defects.updated");
        $updatedby = mysql_result($inner, $a, "TRM_defects.updatedby");
        $priority = str_replace(" ", "_", mysql_result($inner, $a, "TRM_defects.priority"));
        $t_id = mysql_result($inner, $a, "t_id");
        if ($t_id != '') {
            $temp_t_id = $t_id;
            $s_idresult = $dbh->select('TRM_test', "WHERE ID=$t_id", '*');
            $t_id = NULL;
            while ($row2 = mysql_fetch_array($s_idresult)) {
                $s_id = $row2['s_id'];
                $t_id = $temp_t_id;
            }
        }
        $r_id_array = array();
        if ($t_id == NULL) {
            $t_id = 'N/A';
        } else {
            $inner2 = $lh->select('
        TRM_test, TRM_suite, TRM_ReqsTests, TRM_requirements', "WHERE 
        TRM_test.id = $t_id AND 
        TRM_test.s_id = TRM_suite.id AND
        TRM_suite.analysis = '1'  AND
        TRM_test.name = TRM_ReqsTests.t_name AND
        TRM_ReqsTests.r_id = TRM_requirements.id AND
        TRM_requirements.p_id = $p_id
        ", '*');
            $inner2_num_row = mysql_numrows($inner2);
            for ($b = 0;$b < $inner2_num_row;$b++) {
                $r_id = mysql_result($inner2, $b, "TRM_requirements.id");
                $r_name = mysql_result($inner2, $b, "TRM_requirements.name");
                $r_id_array[$r_id] = $r_name;
            }
        }
        $defect_short_description = mysql_result($inner, $a, "TRM_type_of_defects.name");
        $type_imgpath = mysql_result($inner, $a, "TRM_type_of_defects.imgpath");
        $type_of_defect = mysql_result($inner, $a, "type_of_defect");
        $defectname = mysql_result($inner, $a, "name");
        $description_of_defect = mysql_result($inner, $a, "description");
        //$defect_long_description = mysql_result($inner,$a,"defect_description");
        $p_id2 = mysql_result($inner, $a, "p_id");
        if ($bgcolor == 'rgb(211, 211, 211)') {
            $bgcolor = 'transparent';
        } else {
            $bgcolor = 'rgb(211, 211, 211)';
        }
        $status_short_description2 = str_replace(" ", "_", $status_short_description);
        echo "
        <tr style='background-color: $bgcolor;'>
          <td>$created</td>
          <td>" . getNameFromID($createdby) . "</td>
          <td>$updated</td>
          <td>" . getNameFromID($updatedby) . "</td>
          <td><a href='' onclick=" . '"' . "window.open('editDefectPopup.php?d_id=$d_id','mitvindue','height=750,width=620,resizable=no,scrolling=yes');return false;" . '"' . ">$defectname</a></td>
          <td><img src='img/priority$priority.gif' /></td>
          <td><img src='$type_imgpath' alt='type of defect'/>" . $lh->getText($defect_short_description) . "</td>
          <td><img src='$status_imgpath' alt='status short description'/>" . $lh->getText($status_short_description) . "</td>
          <td>";
        if ($t_id != 'N/A') {
            echo "<a href='showReport.php?id=$s_id&amp;highlight=$t_id'>";
        }
        echo "$t_id";
        if ($t_id != 'N/A') {
            echo "</a>";
        }
        echo "</td>
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
        echo "</td>
        </tr>";
    }
    echo "</table>";
    echo "<div><button onclick=" . '"' . "window.open('editDefectPopup.php','mitvindue','height=750,width=620,resizable=no,scrolling=yes');return false;" . '"' . ">" . $lh->getText('Add defect') . "</button></div>";
} else {
    echo "<h1>" . $lh->getText('Choose project') . "</h1>";
} ?>
  </body>
</html>
