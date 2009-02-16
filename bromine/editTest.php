<?php include 'protected.php'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
     <?php include ('header.php'); ?>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
  <?php
$t_id = $_GET['t_id'];
$p_id = $_SESSION['p_id'];
if ($_GET['action'] == 'passman') {
    $t_manstatuscur = $_GET['status'];
    if ($t_manstatuscur == '') {
        $dbh->update('trm_test', "manstatus = 'passed'", "ID = $t_id");
    } else {
        $dbh->update('trm_test', "manstatus = ''", "ID = $t_id");
    }
}
$result = $dbh->select('trm_suite, trm_test, trm_os, trm_browser', "WHERE trm_suite.ID=trm_test.s_id AND 
    trm_test.ID=$t_id AND
    trm_suite.browser=trm_browser.ID AND
    trm_suite.platform=trm_os.ID", "trm_test.name as name, trm_test.status as status, manstatus, Thelp, OSname, browsername, timeDate");
while ($row = mysql_fetch_array($result)) {
    $t_name = $row['name'];
    $t_status = $row['status'];
    $t_manstatus = $row['manstatus'];
    $t_help = $row['Thelp'];
    $OS = $row['OSname'];
    $browser = $row['browsername'];
    $timedate = $row['timeDate'];
    $t_status_org = $t_status;
    if ($t_manstatus != "") {
        $t_status = $t_manstatus;
        $t_name.= " (" . $lh->getText('Manually passed') . ")";
    }
    echo "
      <table>
        <tr>
          <td><b>" . $lh->getText('Test name') . ":</b></td>
          <td class='status_$t_status'>$t_name</td>
        </tr>
        <tr>
          <td><b>" . $lh->getText('Help') . ":</b></td>
          <td>$t_help</td>
        </tr>
        <tr>
          <td><b>" . $lh->getText('Client') . ":</b></td>
          <td>$OS/$browser</td>
        </tr>
        <tr>
          <td><b>" . $lh->getText('Time date') . ":</b></td>
          <td>$timedate</td>
        </tr>
      </table>";
    echo "<div>";
    if (mysql_result($dbh->select('trm_projects', "WHERE `id` = '$p_id'", '*'), 0, "outsidedefects") == 0) {
        $adddefectpage = "editDefectPopup.php?t_id=$t_id";
    } else {
        $adddefectpage = mysql_result($dbh->select('trm_projects', "WHERE `id` = '$p_id'", '*'), 0, "adddefecturl");
    }
    echo "<button onclick=" . '"' . "window.open('$adddefectpage','mitvindue2','height=750,width=620,resizable=no,scrolling=yes');return false;" . '"' . ">" . $lh->getText('Add defect') . "</button>";
    if ($t_status_org == 'failed') {
        echo "<button onclick=" . '"' . "window.location='?t_id=$t_id&amp;action=passman&amp;status=$t_manstatus'" . '"' . ">";
        if ($t_manstatus == 'passed') {
            echo $lh->getText('Remove manual pass');
        } else {
            echo $lh->getText('Pass manually');
        }
        echo "</button>";
    }
    echo "</div>";
}
echo "<div><button onclick=" . '"' . "window.open('addComment.php?table=trm_test&amp;id=" . $t_id . "','mitvindue2','height=250,width=180,resizable=no,scrolling=no');return false;" . '"' . " style='cursor: pointer;'>" . $lh->getText('Add comment') . "</button></div>";
echo "<div style='width: 600px; height: 300px; overflow: auto;'>";
$commentresult = $dbh->select('trm_comments, trm_users', "WHERE trm_comments.table_name='trm_test' AND
     trm_comments.table_id='$t_id' AND
     trm_comments.author=trm_users.ID ORDER BY trm_comments.ID ASC", 'trm_comments.timedate as timedate,
      trm_comments.headline as headline,
      trm_comments.comment as comment,
      trm_users.name as author
     ');
while ($row2 = mysql_fetch_array($commentresult)) {
    $timedate = $row2['timedate'];
    $author = $row2['author'];
    $headline = $row2['headline'];
    $comment = $row2['comment'];
    echo "$timedate $author <b>$headline</b>
      <br />
      " . nl2br($comment) . "
      <br />
      <hr />";
}
echo "</div>";
?>
    
  </body>
</html>
