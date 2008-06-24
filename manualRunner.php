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
$p_id = $_SESSION['p_id'];
if ($p_id != '') {
    include_once ('phpSniff.class.php');
    $client = new phpSniff();
    $browsersuggest = $client->property('long_name') . " " . $client->property('version');
    $platformsuggest = $client->property('platform') . " " . $client->property('os');
    echo "<form method='get' action='createManSuite.php' target='blank'>";
    echo "<table>";
    echo "<tr>";
    echo "<td>" . $lh->GetText('Choose your current browser') . ":</td>";
    echo "<td>";
    $browser = $_GET['browser'];
    $result = $dbh->select('TRM_browser', "ORDER BY browsername", "*");
    $numreports = mysql_numrows($result);
    echo "<select name='browser'>";
    echo "<option value=''>" . $lh->getText('Choose') . "</option>";
    for ($i = 0;$i < $numreports;$i++) {
        echo "<option value='" . mysql_result($result, $i, "ID") . "'";
        if ($OS == mysql_result($result, $i, "ID") || preg_match("/${browsersuggest}/i", mysql_result($result, $i, "browsername"))) {
            echo ' selected="selected"';
        }
        echo ">" . mysql_result($result, $i, "browsername") . "</option>";
    }
    echo "</select>";
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>" . $lh->GetText('Choose your current OS') . ":</td>";
    echo "<td>";
    $OS = $_GET['OS'];
    $result = $dbh->select('TRM_OS', "ORDER BY OSname", "*");
    $numreports = mysql_numrows($result);
    echo "<select name='OS'>";
    echo "<option value=''>" . $lh->getText('Choose') . "</option>";
    for ($i = 0;$i < $numreports;$i++) {
        echo "<option value='" . mysql_result($result, $i, "ID") . "'";
        if ($OS == mysql_result($result, $i, "ID") || preg_match("/${platformsuggest}/i", mysql_result($result, $i, "OSname"))) {
            echo ' selected="selected"';
        }
        echo ">" . mysql_result($result, $i, "OSname") . "</option>";
    }
    echo "</select>";
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>" . $lh->GetText('Choose test') . ":</td>";
    echo "<td>";
    $result = $dbh->sql("SELECT * FROM TRM_design_manual_test WHERE p_id=$p_id ORDER BY name");
    $numreports = mysql_numrows($result);
    echo "<select name='td_id'>";
    echo "<option value=''>" . $lh->getText('Choose') . "</option>";
    for ($i = 0;$i < $numreports;$i++) {
        echo "<option value='" . mysql_result($result, $i, "ID") . "'";
        if ($OS == mysql_result($result, $i, "id")) {
            echo ' selected="selected"';
        }
        echo ">" . mysql_result($result, $i, "name") . "</option>";
    }
    echo "</select><br />";
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>" . $lh->GetText('Choose environment') . ":</td>";
    echo "<td>";
    $siteresult = $dbh->select('TRM_projects_has_sites', "WHERE p_id=$p_id ORDER BY sitetotest", "*");
    while ($row = mysql_fetch_array($siteresult)) {
        $sitetotests[] = $row['sitetotest'];
    }
    echo "<select name='sitetotest'>";
    echo "<option value=''>" . $lh->getText('Choose') . "</option>";
    foreach($sitetotests as $key => $site) {
        echo "<option value='$site'";
        echo ">$site</option>";
    }
    echo "</select>";
    echo "</td>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>Start:</td>";
    echo "<td>";
    echo "<input type='submit' value='GO'/><br />";
    echo "</td>";
    echo "</tr>";
    echo "</table>";
    echo "</form>";
} else {
    echo $lh->getText('Choose project');
}
?>
  </body>
</html>
