<?php include ('protected.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php include ('header.php'); ?>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
    <?php 
require 'menu.php';
BromineSubmenu::renderTestLabSubmenu();
?>
    <form action='saveTestPlan.php' method='post'>
      <table>
        <tr>
          <th align="left"><?php echo $lh->getText('Nr'); ?></th>
      		<th align="left"><?php echo $lh->getText('Requirement'); ?></th>
      		<th align="left"><?php echo $lh->getText('Description'); ?></th>
      		<th align="left"><?php echo $lh->getText('Test'); ?></th>
        </tr>
        <?php
$p_id = $_SESSION['p_id'];
$u_id = $_SESSION['id'];
$testresult = $dbh->select('trm_test, trm_suite', join(" ", array("WHERE trm_test.s_id=trm_suite.ID ", "AND trm_suite.p_id='$p_id'", "ORDER BY trm_suite.suitename, trm_test.name")), 'DISTINCT trm_test.name');
$tests = Array();
while ($row = mysql_fetch_array($testresult)) {
    $tests[] = $row['name'];
}
$outer_result = $dbh->select("trm_requirements, trm_projectlist", join(" ", array("WHERE trm_requirements.p_id = '$p_id' ", "AND trm_projectlist.projectID=trm_requirements.p_id", "AND trm_projectlist.userID='$u_id' ", "AND trm_projectlist.access='1'", "ORDER BY trm_requirements.name",)), "*");
$outer_num_row = mysql_numrows($outer_result);
for ($i = 0;$i < $outer_num_row;$i++) {
    $r_id = mysql_result($outer_result, $i, "trm_requirements.ID");
    $r_nr = mysql_result($outer_result, $i, "trm_requirements.nr");
    $r_name = mysql_result($outer_result, $i, "trm_requirements.name");
    $r_description = mysql_result($outer_result, $i, "trm_requirements.description");
    if (strlen($r_description) > 200) {
        $r_description = substr($r_description, 0, 200) . "...";
    } else {
        $r_description = "$r_description...";
    }
    echo "<tr valign='top'>";
    echo "<td>";
    echo $r_nr;
    echo "</td>";
    echo "<td>";
    echo "<a href='showFullReqs.php?reqID=$r_id' title='" . $lh->getText('Show full desc') . "'>$r_name</a>";
    echo "</td>";
    echo "<td style='width: 500px'>";
    echo $r_description;
    echo "</td>";
    echo "<td>";
    $inner_result = $dbh->select("trm_requirements, trm_reqstests", join(" ", array("WHERE trm_requirements.ID = '$r_id' ", "AND trm_reqstests.r_id=trm_requirements.id", "ORDER BY trm_reqstests.t_name")), "*");
    $inner_num_row = mysql_numrows($inner_result);
    for ($a = 0;$a < $inner_num_row;$a++) {
        $t_name = mysql_result($inner_result, $a, "trm_reqstests.t_name");
        $rt_id = mysql_result($inner_result, $a, "trm_reqstests.ID");
        #              echo "<select name='test[$rt_id]'>";
        #              foreach ($tests as $v){
        #                echo "<option value='$v' ";
        #                if($t_name==$v){echo "selected='selected'";}
        #                echo ">$v</option>";
        #              }
        $result1 = $dbh->select('trm_design_manual_test', join(" ", array("WHERE p_id=$p_id", "ORDER BY name")), '*');
        echo ($a+1) . ": ";
        echo "<select name='test[$rt_id]'>";
        echo "<option value=''>" . $lh->getText('Choose') . "</option>";
        while ($row = mysql_fetch_array($result1)) {
            echo "<option value='" . $row['name'] . "' ";
            if ($row['name'] == $t_name) {
                echo "selected='selected'";
            }
            echo ">" . $row['name'] . "</option>";
        }
        $confirm = '"' . $lh->getText('confirmDelete') . '"';
        echo "</select><a href='delete.php?type=ReqsTest&amp;id=$rt_id&amp;back=editTestPlan.php' onclick='return confirm($confirm)' ><img src='img/trashcan.gif' alt='" . $lh->getText('Delete') . "' /></a><br />";
    }
    echo $lh->getText('Add test to this requirement') . "<br />";
    $result1 = $dbh->select('trm_design_manual_test', join(" ", array("WHERE p_id=$p_id", "ORDER BY name")), '*');
    echo "<select name='newtest[$r_id]'>";
    echo "<option value=''>" . $lh->getText('Choose') . "</option>";
    while ($row = mysql_fetch_array($result1)) {
        echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
    }
    echo "</select>";
    echo "</td>";
    echo "</tr>";
    echo "<tr class='border'>";
    echo "<td colspan='5'>&nbsp;</td>";
    echo "</tr>";
    //print_r($testlist);
    $testlist = array();
}
?>
      </table>
      <div><input type='submit' value='<?php echo $lh->getText('Submit'); ?>' /></div>
    </form>
  </body>
</html>
