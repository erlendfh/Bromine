<?php include ('protected.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php include ('header.php'); ?>
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
    <?php 
include ('menu.php');
    $submenu = new BromineSubmenu();
    $submenu->testLab();
    $submenu->display();
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
$result = $dbh->select('TRM_core_testsuites, TRM_projects, TRM_projectList', "WHERE TRM_projectList.userId = '" . $_SESSION['id'] . "' AND 
        TRM_projectList.access='1' AND
        TRM_projects.ID=$p_id AND 
        TRM_projectList.projectID=TRM_projects.ID AND 
        TRM_projects.ID!=1 AND
        TRM_core_testsuites.p_id = TRM_projects.ID", "TRM_core_testsuites.*");
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
