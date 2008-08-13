<?php require 'protected.php'; ?>
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
    <form action='saveCoreSuites.php' method='post'>
      <table>
        <tr>
          <th align='left'>  
            <?php echo $lh->getText('Suite name') ?>
          </th>
          <th align='left'>  
            <?php echo $lh->getText('Delete') ?>
          </th>
        </tr>
      <?php
$p_id = $_SESSION['p_id'];
$confirm = '"' . $lh->getText('confirmDelete') . '"';
$result = $dbh->select('trm_core_testsuites, trm_projects, trm_projectlist', "WHERE trm_projectlist.userId = '" . $_SESSION['id'] . "' AND 
        trm_projectlist.access='1' AND
        trm_projects.ID=$p_id AND 
        trm_projectlist.projectID=trm_projects.ID AND 
        trm_projects.ID!=1 AND
        trm_core_testsuites.p_id = trm_projects.ID", "trm_core_testsuites.*");
$numreports = mysql_numrows($result);
for ($i = 0;$i < $numreports;$i++) {
    echo "<tr>";
    $t_id = mysql_result($result, $i, "id");
    $testsuite = mysql_result($result, $i, "testsuite");
    echo "<td><input type='hidden' value='$t_id' name='core_t_id[]' size='0'/>";
    echo "<input type='text' value='$testsuite' name='core_testsuite[]' size='40' /></td>";
    echo "<td><a href='delete.php?type=coretest&amp;id=$t_id&amp;back=editCoreSuites.php' onclick='return confirm($confirm)' ><img src='img/trashcan.gif' /></a></td>";
    echo "</tr>";
}
?>
        <tr>
          <td colspan='4'>
            <?php echo $lh->getText('Add test to this project'); ?>
          </td>
        </tr>
        <tr>
          <td>
            <input type='text' name='newcore_testsuite' size='40' />
          </td>
        </tr>
      </table>
      <div><input type='submit' value='<?php echo $lh->getText('Submit'); ?>' />
    </form>
  </body>
</html>
