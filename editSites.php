<?php include ('protected.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  	<?php include ('header.php'); ?>
  	<link rel="stylesheet" type="text/css" href="style.css" />
    <script type="JavaScript" src="js/collapse_expand_single_item.js"></script>
  </head>
  <body>
<?php 
require 'menu.php';
BromineSubmenu::renderAdminSubmenu();
    
$p_id = $_SESSION['p_id'];
?>
    
    
    <?php
if ($p_id != '') { ?>
      <form action='saveSites.php' method='post'>
        <div><input type='hidden' name='p_id' value='<?php echo $p_id ?>' /></div>
        <table>
          <tr>
            <th align='left'>  
              <?php echo $lh->getText('Environment') ?>
            </th>
            <th align='left'>  
              <?php echo $lh->getText('TR location') ?>
            </th>
            <th align='left'>  
              <?php echo $lh->getText('Testsuite path') ?>
            </th>
            <th align='left'>  
              <?php echo $lh->getText('Delete') ?>
            </th>
          </tr>
        <?php
    $result = $dbh->select('TRM_core, TRM_projects, TRM_projectList', "WHERE TRM_projectList.userId = '" . $_SESSION['id'] . "' AND 
            TRM_projectList.access = '1' AND
            TRM_projects.ID='$p_id' AND 
            TRM_projectList.projectID = TRM_projects.ID AND 
            TRM_projects.ID != 1 AND
            TRM_core.p_id = TRM_projects.ID", "TRM_core.*");
    $numreports = mysql_numrows($result);
    for ($i = 0;$i < $numreports;$i++) {
        echo "<tr>";
        $c_id = mysql_result($result, $i, "ID");
        $core_referer = mysql_result($result, $i, "referer");
        $TestRunnerLocation = mysql_result($result, $i, "TestRunnerLocation");
        $testPath = mysql_result($result, $i, "testPath");
        echo "<td id='$c_id'><input type='hidden' value='$c_id' name='c_id[]' size='0'/>";
        echo "<input type='text' value='$core_referer' name='core_referer[]' size='30' /></td>";
        echo "<td><input type='text' value='$TestRunnerLocation' name='TestRunnerLocation[]' size='60'  /></td>";
        echo "<td><input type='text' value='$testPath' name='testPath[]' size='30'  /></td>";
        $confirm = '"' . $lh->getText('confirmDelete') . '"';
        echo "<td><a href='delete.php?type=core&amp;id=$c_id&amp;back=editSites.php?p_id=$p_id' onclick='return confirm($confirm)' ><img src='img/trashcan.gif' alt='" . $lh->getText('Delete') . "'/></a></td>";
        echo "</tr>";
    }
?>
          <tr>
            <td colspan='5'>
              <?php echo $lh->getText('Add test to this project'); ?>
            </td>
          </tr>
          <tr>
            <td><input type='text' name='newcore_referer' size='30' /></td>
            <td><input type='text' name='newTestRunnerLocation' size='60' /></td>
            <td><input type='text' name='newtestPath' size='30' /></td>
          </tr>
        </table>

        <div><input type='submit' value='<?php echo $lh->getText('Submit'); ?>' /></div>
      </form>

      <?php
}
?>
  </body>
</html>
