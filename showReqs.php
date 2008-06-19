<?php include ('protected.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php include ('header.php'); ?>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script type="text/javaScript" src="js/popup.js"></script>
  </head>
  <body>
    <?php include ('menu.php') ?>
    <?php include ('TRMSubMenu.php') ?>

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
$outer_result = $dbh->select("TRM_requirements, TRM_projectList", join(" ", array("WHERE TRM_requirements.p_id = '$p_id'", "AND TRM_projectList.projectID=TRM_requirements.p_id", "AND TRM_projectList.userID='$u_id' ", "AND TRM_projectList.access='1'", "ORDER BY TRM_requirements.nr",)), "*");
$outer_num_row = mysql_numrows($outer_result);
for ($i = 0;$i < $outer_num_row;$i++) {
    $r_id = mysql_result($outer_result, $i, "TRM_requirements.ID");
    $r_nr = mysql_result($outer_result, $i, "TRM_requirements.nr");
    $r_name = mysql_result($outer_result, $i, "TRM_requirements.name");
    $r_priority = mysql_result($outer_result, $i, "TRM_requirements.priority");
    $r_description = mysql_result($outer_result, $i, "TRM_requirements.description");
    if (strlen($r_description) > 70) {
        $r_description = "<a href='showFullReqs.php?reqID=$r_id' target='_blank' title='" . $dbh->getText('Show full desc') . "'>" . substr($r_description, 0, 70) . "...</a>";
    } else {
        $r_description = "<a href='showFullReqs.php?reqID=$r_id' target='_blank' title='" . $dbh->getText('Show full desc') . "'>" . $r_description . "...</a>";
    }
    $OSBrowsAllresult = $dbh->select("TRM_ReqsOSBrows, TRM_OS, TRM_browser", join(" ", array("WHERE TRM_ReqsOSBrows.r_id = '$r_id'", "AND TRM_browser.ID=TRM_ReqsOSBrows.b_id", "AND TRM_OS.ID=TRM_ReqsOSBrows.o_id")), "*");
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
    $test_result = $dbh->select("TRM_ReqsTests", join(" ", array("WHERE r_id = '$r_id'", "ORDER BY t_name")), "*");
    $test_num_row = mysql_numrows($test_result);
    echo "<table>";
    for ($b = 0;$b < $test_num_row;$b++) {
        echo "<tr>";
        $t_name = mysql_result($test_result, $b, "t_name");
        $inner_result = $dbh->sql("
              SELECT * FROM TRM_requirements, TRM_ReqsTests, TRM_ReqsOSBrows, TRM_test, TRM_OS, TRM_browser, TRM_suite,
              
                (SELECT MAX(TRM_suite.ID) as max_s_id FROM
                TRM_requirements, TRM_ReqsTests, TRM_ReqsOSBrows, TRM_test, TRM_OS, TRM_browser, TRM_suite
                WHERE TRM_requirements.ID=$r_id AND
                TRM_ReqsTests.t_name='$t_name' AND
                TRM_ReqsTests.r_id=TRM_requirements.id AND
                TRM_ReqsOSBrows.r_id=TRM_requirements.id AND
                TRM_test.name=TRM_ReqsTests.t_name AND
                TRM_browser.ID=TRM_ReqsOSBrows.b_id AND
                TRM_OS.ID=TRM_ReqsOSBrows.o_id AND
                TRM_suite.ID=TRM_test.s_id AND
                TRM_suite.platform=TRM_OS.ID AND
                TRM_suite.analysis=1 AND
                TRM_suite.browser=TRM_browser.ID GROUP BY TRM_ReqsOSBrows.ID) TRM_maxresults
                
              WHERE TRM_requirements.ID=$r_id AND
              TRM_ReqsTests.t_name='$t_name' AND
              TRM_ReqsTests.r_id=TRM_requirements.id AND
              TRM_ReqsOSBrows.r_id=TRM_requirements.id AND
              TRM_test.name=TRM_ReqsTests.t_name AND
              TRM_browser.ID=TRM_ReqsOSBrows.b_id AND
              TRM_OS.ID=TRM_ReqsOSBrows.o_id AND
              TRM_suite.ID=TRM_test.s_id AND
              TRM_suite.platform=TRM_OS.ID AND
              TRM_suite.ID = TRM_maxresults.max_s_id AND
              TRM_suite.browser=TRM_browser.ID GROUP BY TRM_ReqsOSBrows.ID ORDER BY TRM_requirements.priority ASC");
        $num_inner_result = mysql_numrows($inner_result);
        $taken = array();
        $toPrint = array();
        for ($a = 0;$a < $num_inner_result;$a++) {
            $inner_num_row = mysql_numrows($inner_result);
            $t_id = mysql_result($inner_result, $a, "TRM_test.ID");
            $s_id = mysql_result($inner_result, $a, "max_s_id");
            $t_status = mysql_result($inner_result, $a, "TRM_test.status");
            $t_manstatus = mysql_result($inner_result, $a, "TRM_test.manstatus");
            $OS = mysql_result($inner_result, $a, "TRM_OS.OSname");
            $browser = mysql_result($inner_result, $a, "TRM_browser.browsername");
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
