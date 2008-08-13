<?php
include ('protected.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php include ('header.php'); ?>
    <link rel="stylesheet" type="text/css" href="print.css" />

  </head>
  <body>

  
  <?php
include 'matrix.php';
$p_id = $_SESSION['p_id'];
$u_id = $_SESSION['id'];
$user = $_SESSION['user'];
//$OSs
$showThisID = $_GET['reqID'];
$result = $dbh->select("trm_requirements, trm_projectlist", "WHERE trm_projectlist.projectID=trm_requirements.p_id AND trm_projectlist.userID='$u_id' AND trm_projectlist.access='1' AND trm_requirements.id = '$showThisID' ORDER BY trm_requirements.priority", "trm_requirements.*");
$num_row = mysql_numrows($result);
if ($num_row > 0) {
    $r_id = mysql_result($result, 0, "trm_requirements.id");
    $name = mysql_result($result, 0, "name");
    $nr = mysql_result($result, 0, "nr");
    $author = mysql_result($result, 0, "author");
    $description = nl2br(mysql_result($result, 0, "description"));
    $priority = mysql_result($result, 0, "priority");
    $rresult = $dbh->select("trm_regsosbrows, trm_os, trm_browser", "WHERE trm_regsosbrows.r_id = '$r_id' AND 
      trm_os.ID = trm_regsosbrows.o_id AND
      trm_browser.ID = trm_regsosbrows.b_id", "*");
    $rnum_row = mysql_numrows($rresult);
    for ($b = 0;$b < $rnum_row;$b++) {
        $OScur = mysql_result($rresult, $b, "OSname");
        $Browsercur = mysql_result($rresult, $b, "browsername");
        $ID = mysql_result($rresult, $b, "ID");
        $OSs[] = $OScur;
        $Brows[] = $Browsercur;
    }
    //echo "$author";
    $priority2 = str_replace(" ", "_", $priority);
    $priority = $lh->getText($priority);
    echo "
      <h2>" . $lh->getText('Project') . ": " . $_SESSION['p_name'] . "</h2>
      <p>" . $lh->getText('Name') . ": $name</p>
      <p>" . $lh->getText('Nr') . ": $nr</p>
      <p>" . $lh->getText('Priority') . ": ";
    echo "<img src='img/priority$priority2.gif' alt='lala'/> - $priority</p>
      <p>" . $lh->getText('Author') . ": $author</p>
      <p>" . $lh->getText('Description') . ": </p>
      <div style='width: 800px;'>$description</div>
      <p>" . $lh->getText('matrix') . ":</p>
      ";
    createMatrix($OSs, $Brows, $dbh);
}
?>
    </body>
</html>
