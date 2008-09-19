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
require 'menu.php';
BromineSubmenu::renderTestResultManagerSubmenu();
?>
    <div id="object1" style="position:absolute; background-color: #FFFFDD; color:black; border-color:black; border-width:1px; visibility:visible; left:25px; top:-100px; z-index:1" onmouseover="Popup.over()" onmouseout="Popup.out()">
      pop up description layer
    </div>
    <form action='saveReqs.php' method='post'>
      <table border='0'>
        <tr valign='top'>
          <th align="left"><?php echo $lh->getText('Nr'); ?></th>
      		<th align="left"><?php echo $lh->getText('Requirement'); ?></th>
      		<th align="left"><?php echo $lh->getText('Priority'); ?></th>
      		<th align="left"><?php echo $lh->getText('Description'); ?></th>
      		<th align="left"><?php echo $lh->getText('OS/Browser requirements'); ?></th>
        </tr>
        <?php
$p_id = $_SESSION['p_id'];
$u_id = $_SESSION['id'];
include "matrix.php";
$outer_result = $dbh->select("trm_requirements, trm_projectlist", join(" ", array("WHERE trm_requirements.p_id = '$p_id'", "AND trm_projectlist.projectID=trm_requirements.p_id", "AND trm_projectlist.userID='$u_id' ", "AND trm_projectlist.access='1'", "ORDER BY trm_requirements.nr",)), "*");
$outer_num_row = mysql_numrows($outer_result);
for ($i = 0;$i < $outer_num_row;$i++) {
    $r_id = mysql_result($outer_result, $i, "trm_requirements.ID");
    $r_nr = mysql_result($outer_result, $i, "trm_requirements.nr");
    $r_name = mysql_result($outer_result, $i, "trm_requirements.name");
    $r_priority = mysql_result($outer_result, $i, "trm_requirements.priority");
    $r_description = mysql_result($outer_result, $i, "trm_requirements.description");
    if (strlen($r_description) > 70) {
        $r_description = "<a href='showFullReqs.php?reqID=$r_id' target='_blank' title='" . $dbh->getText('Show full desc') . "'>" . substr($r_description, 0, 70) . "...</a>";
    } else {
        $r_description = "<a href='showFullReqs.php?reqID=$r_id' target='_blank' title='" . $dbh->getText('Show full desc') . "'>" . $r_description . "...</a>";
    }
    $OSBrowsAllresult = $dbh->select("trm_reqsosbrows, trm_os, trm_browser", join(" ", array("WHERE trm_reqsosbrows.r_id = '$r_id'", "AND trm_browser.ID=trm_reqsosbrows.b_id", "AND trm_os.ID=trm_reqsosbrows.o_id")), "*");
    $OSBrowsAll = Array();
    while ($row = mysql_fetch_array($OSBrowsAllresult)) {
        $OSBrowsAll[] = $row['OSname'] . "/" . $row['browsername'];
    }
    if ($bgcolor == 'rgb(211,211,211)') {
        $bgcolor = 'transparent';
    } else {
        $bgcolor = 'rgb(211,211,211)';
    }
    echo "<tr valign='top' style='background-color: $bgcolor;' id='$r_id'>";
    echo "<td>";
    echo $r_nr;
    echo "</td>";
    echo "<td>";
    echo "<b>$r_name</b>";
    echo "</td>";
    echo "<td>";
    $priority2 = str_replace(" ", "_", $r_priority);
    echo "<img src='img/priority$priority2.gif' title='" . $lh->getText($r_priority) . "' alt='" . $lh->getText($r_priority) . "'/>";
    echo "</td>";
    echo "<td>";
    echo $r_description;
    echo "</td>";
    echo "<td>";
    $test_result = $dbh->select("trm_reqstests", join(" ", array("WHERE r_id = '$r_id'", "ORDER BY t_name")), "*");
    $test_num_row = mysql_numrows($test_result);
    echo "<table>";
    for ($b = 0;$b < $test_num_row;$b++) {
        echo "<tr>";
        $t_name = mysql_result($test_result, $b, "t_name");
        $inner_result = $dbh->sql("
              SELECT * FROM trm_requirements, trm_reqstests, trm_reqsosbrows, trm_test, trm_os, trm_browser, trm_suite,
              
                (SELECT MAX(trm_suite.ID) as max_s_id FROM
                trm_requirements, trm_reqstests, trm_reqsosbrows, trm_test, trm_os, trm_browser, trm_suite
                WHERE trm_requirements.ID=$r_id AND
                trm_reqstests.t_name='$t_name' AND
                trm_reqstests.r_id=trm_requirements.id AND
                trm_reqsosbrows.r_id=trm_requirements.id AND
                trm_test.name=trm_reqstests.t_name AND
                trm_browser.ID=trm_reqsosbrows.b_id AND
                trm_os.ID=trm_reqsosbrows.o_id AND
                trm_suite.ID=trm_test.s_id AND
                trm_suite.platform=trm_os.ID AND
                trm_suite.analysis=1 AND
                trm_suite.browser=trm_browser.ID GROUP BY trm_reqsosbrows.ID) trm_maxresults
                
              WHERE trm_requirements.ID=$r_id AND
              trm_reqstests.t_name='$t_name' AND
              trm_reqstests.r_id=trm_requirements.id AND
              trm_reqsosbrows.r_id=trm_requirements.id AND
              trm_test.name=trm_reqstests.t_name AND
              trm_browser.ID=trm_reqsosbrows.b_id AND
              trm_os.ID=trm_reqsosbrows.o_id AND
              trm_suite.ID=trm_test.s_id AND
              trm_suite.platform=trm_os.ID AND
              trm_suite.ID = trm_maxresults.max_s_id AND
              trm_suite.browser=trm_browser.ID GROUP BY trm_reqsosbrows.ID ORDER BY trm_requirements.priority ASC");
        $num_inner_result = mysql_numrows($inner_result);
        $taken = array();
        $toPrint = array();
        for ($a = 0;$a < $num_inner_result;$a++) {
            $inner_num_row = mysql_numrows($inner_result);
            $t_id = mysql_result($inner_result, $a, "trm_test.ID");
            $s_id = mysql_result($inner_result, $a, "max_s_id");
            $t_status = mysql_result($inner_result, $a, "trm_test.status");
            $t_manstatus = mysql_result($inner_result, $a, "trm_test.manstatus");
            $OS = mysql_result($inner_result, $a, "trm_os.OSname");
            $browser = mysql_result($inner_result, $a, "trm_browser.browsername");
            if ($t_manstatus != '') {
                $t_status = $t_manstatus;
            }
            //echo $t_status;
            if ($t_status == "passed") {
                $OSSuccess[] = $OS;
                $BrowSuccess[] = $browser;
                //$toPrintSuccess[] = "<a href="."'"."showReport.phpid=$s_id&amp;hightligh=$t_id"."'".">X</a>";
                $toPrintSuccess[] = "$s_id/$t_id";
            } elseif ($t_status == "failed") {
                $OSFailed[] = $OS;
                $BrowFailed[] = $browser;
                $toPrintFailed[] = "$s_id/$t_id";
                //$toPrintFailed[] = "<a href="."'"."showReport.phpid=$s_id&amp;hightlight=$t_id"."'".">X</a>";
                
            }
            // href='showReport.php?id=$s_id&hightlight=$t_id'
            //$toPrintSuccess[] = "<a href="."'"."showReport.phpid=$s_id&amp;hightligh=$t_id"."'".">X</a>";
            //$toPrint[] = "<span class='status_$t_status'><a href='showReport.php?id=$s_id&hightlight=$t_id'>$OS/$browser</a></span> ";
            $taken[] = "$OS/$browser";
        }
        foreach($OSBrowsAll as $v) {
            if (!in_array($v, $taken)) {
                $toPrint[] = "<span class='status_notdone'>$v</span> ";
                $t = split('/', $v);
                $OSNotDone[] = $t[0];
                $BrowNotDone[] = $t[1];
            }
        }
        if (count($OSFailed) > 0) {
            $status = "failed";
        } elseif (count($OSNotDone) > 0) {
            $status = "notdone";
        } elseif (count($OSSuccess) > 0) {
            $status = "passed";
        }
        //
        $mAdv = createMatrixAdv($OSSuccess, $BrowSuccess, $OSFailed, $BrowFailed, $OSNotDone, $BrowNotDone, $toPrintSuccess, $toPrintFailed, $dbh);
        $OSSuccess = array();
        $BrowSuccess = array();
        $OSFailed = array();
        $BrowFailed = array();
        $OSNotDone = array();
        $BrowNotDone = array();
        $toPrintSuccess = array();
        $toPrintFailed = array();
        echo "<td class='status_" . $status . "'>
                <script type='text/javascript'>
                <!--
                function showmatrix$kk(){
                  Popup.popLayer(" . '"' . "$mAdv" . '"' . ");
                }
                -->
                </script>
                <a title='" . $lh->getText('View Matrix') . "' class='full' style='cursor: pointer' onclick=" . '"' . "showmatrix$kk()" . '"' . ">" . ($b+1) . ": $t_name</a>
                </td>";
        $kk++;
        echo "<td>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</td>";
    echo "</tr>";
}
?>
      </table>
    </form>
  </body>
</html>
