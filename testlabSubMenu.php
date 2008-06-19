<?php
$pages = array('editTestCase.php', 'editTestPlan.php', 'simpleFTP.php', 'editCoreSuites.php', 'corerunner.php', 'genericRunner.php', 'manualRunner.php');
$linktext = array('Testcases', 'Test Plan', 'Edit node tests', 'Edit core suites', 'Testrunner core', 'Testrunner nodes', 'Manual runner');
$file = end(explode('/', $_SERVER['SCRIPT_FILENAME']));
$breakCount = 4;
?>
<table class='subMenu'>
<tr>

<?php
foreach($pages as $key => $page) {
    $count++;
    if ($file == $page) {
        $style = 'black';
    } else {
        $style = 'white';
    }
    echo "<td>";
    echo "<div style='background: #FF9900; font-family: verdana; font-weight: bold; height: 20px; cursor: pointer;'>";
    echo "<a href='$page' style='color: $style;' name='menulink'>";
    echo $lh->getText($linktext[$key]);
    echo "</a>";
    echo "</div>";
    echo "</td>";
    if ($count == $breakCount) {
        echo "</tr><tr>";
        $count = 0;
    }
}
?>
</tr>
</table>


  <!--td>  
    <div style='background: #FF9900; font-family: verdana; font-weight: bold; height: 20px; cursor: pointer;'>
      <a href='editCron.php' style='color: white;' name='menulink'>
        <?php echo $lh->getText('Schedule tests'); ?>
      </a>
    </div>
  </td-->
