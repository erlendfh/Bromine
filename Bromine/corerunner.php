<?php include ('protected.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php include ('header.php'); ?>
    <link rel="stylesheet" type="text/css" href="style.css" />
    
    <script type="text/javascript">
    <!--
      function changeIt(id,change){
        elm = document.getElementById(id);
        elm.innerHTML = "<br />"+change;
      }
    -->
    </script>
  </head>
  <body>
<?php 
include 'menu.php';
BromineSubmenu::renderTestLabSubmenu();
$p_id = $_SESSION['p_id'];
$referer = $_GET['referer'];
$testsuite = $_GET['testsuite'];
$interval = $_GET['interval'];
$TestRunnerLocation = $_GET['TestRunnerLocation'];
$testPath = $_GET['testPath'];
?>
    <form method='get' action=''>
      <table>
        
        <tr>
          <td>
            <?php echo $lh->getText('Environment'); ?>
          </td>
          <td>
            <?php
if ($p_id != '') {
    $result = $dbh->select('trm_core, trm_projects, trm_projectlist', "WHERE trm_projectlist.userId = '" . $_SESSION['id'] . "' AND 
                trm_projects.ID='$p_id' AND
                trm_projectlist.access='1' AND 
                trm_projectlist.projectID=trm_projects.ID AND 
                trm_projects.ID!=1 AND 
                trm_core.p_id=trm_projects.ID ", "trm_core.*");
    $numreports = mysql_numrows($result);
    if ($numreports > 0) {
        echo "<input type='hidden' name='TestRunnerLocation' value='" . mysql_result($result, 0, "TestRunnerLocation") . "' />";
        echo "<input type='hidden' name='testPath' value='" . mysql_result($result, 0, "testPath") . "' />";
    }
    echo "<select name='referer' onchange='this.form.submit()'>";
    echo "<option value=''>" . $lh->getText('Choose environment') . "</option>";
    for ($i = 0;$i < $numreports;$i++) {
        echo "<option value='" . mysql_result($result, $i, "referer") . "'";
        if ($referer == mysql_result($result, $i, "referer")) {
            echo ' selected="selected"';
        }
        echo ">" . mysql_result($result, $i, "referer") . "</option>";
    }
    echo "</select>";
}
?>
          </td>
        </tr>
        <tr>
          <td>
            <?php
include_once ('phpSniff.class.php');
$client = new phpSniff();
$browsersuggest = $client->property('long_name') . " " . $client->property('version');
$platformsuggest = $client->property('platform') . " " . $client->property('os');
echo $lh->getText('Choose your current browser') . " ($browsersuggest)"; ?>
          </td>
          <td>
           <?php
$browser = $_GET['browser'];
$result = $dbh->select('trm_browser', "", "*");
$numreports = mysql_numrows($result);
echo "<select name='browser' onchange='this.form.submit()'>";
echo "<option value=''>" . $lh->getText('Choose') . "</option>";
for ($i = 0;$i < $numreports;$i++) {
    echo "<option value='" . mysql_result($result, $i, "ID") . "'";
    if ($OS == mysql_result($result, $i, "ID") || preg_match("/${browsersuggest}/i", mysql_result($result, $i, "browsername"))) {
        echo ' selected="selected"';
    }
    echo ">" . mysql_result($result, $i, "browsername") . "</option>";
}
echo "</select>";
?>
          </td>
        </tr>
        <tr>
          <td>
            <?php
echo $lh->getText('Choose your current OS') . " ($platformsuggest)"; ?>
          </td>
          <td>
           <?php
$OS = $_GET['OS'];
$result = $dbh->select('trm_os', "", "*");
$numreports = mysql_numrows($result);
echo "<select name='OS' onchange='this.form.submit()'>";
echo "<option value=''>" . $lh->getText('Choose') . "</option>";
for ($i = 0;$i < $numreports;$i++) {
    echo "<option value='" . mysql_result($result, $i, "ID") . "'";
    if ($OS == mysql_result($result, $i, "ID") || preg_match("/${platformsuggest}/i", mysql_result($result, $i, "OSname"))) {
        echo ' selected="selected"';
    }
    echo ">" . mysql_result($result, $i, "OSname") . "</option>";
}
echo "</select>";
?>
          </td>
        </tr>
        <tr>
          <td>
            <?php echo $lh->getText('Suite name'); ?>
          </td>
          <td>
            <?php
if ($referer != '' && $browser != '' && $OS != '') {
    $result = $dbh->select('trm_core_testsuites, trm_projects, trm_projectlist', "WHERE trm_projectlist.userId = '" . $_SESSION['id'] . "' AND
                trm_projects.ID='$p_id' AND 
                trm_projectlist.access='1' AND 
                trm_projectlist.projectID=trm_projects.ID AND 
                trm_projects.ID!=1 AND 
                trm_core_testsuites.p_id=trm_projects.ID ", "trm_core_testsuites.*");
    $numreports = mysql_numrows($result);
    echo "<select name='testsuite' onchange='this.form.submit()'>";
    echo "<option value=''>" . $lh->getText('Choose test') . "</option>";
    for ($i = 0;$i < $numreports;$i++) {
        echo "<option value='" . mysql_result($result, $i, "testsuite") . "'";
        if ($testsuite == mysql_result($result, $i, "testsuite")) {
            echo ' selected="selected"';
        }
        echo ">" . mysql_result($result, $i, "testsuite") . "</option>";
    }
    echo "</select>";
}
?>
          </td>
        </tr>
        <tr>
          <td>
            <?php echo $lh->getText('Interval'); ?>
          </td>
          <td>
            <?php
if ($testsuite != '') {
    echo "<select name='interval' onchange='this.form.submit()'>";
    for ($i = 0;$i <= 10;$i++) {
        $t = $i*500;
        echo "<option value='$t'";
        if ($interval == $t) {
            echo ' selected="selected"';
        }
        echo ">" . $t . " ms</option>";
    }
    echo "</select>";
}
?> 
          </td>
        </tr>
      </table>
    </form>
    <?php
if ($p_id != '' && $referer != '' && $testsuite != '') {
    $referer = $referer . "/";
    $resultsurl = "http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . $_SERVER['PHP_SELF'];
    $resultsurl = str_replace('corerunner.php', '', $resultsurl);
    $resultsurl.= "parser.php";
    $result = $dbh->select('trm_users', 'WHERE ID=1', '*');
    $username = mysql_result($result, 0, "name");
    $pass = mysql_result($result, 0, "password");
    $lang = $_SESSION['lang'];
    $url = $referer . $TestRunnerLocation . "?" . join("&", array("test=" . $testPath . $testsuite, "resultsUrl=$resultsurl", "runInterval=$interval", "p_id=$p_id", "o_id=$OS", "u_id=$id", "b_id=$browser", "auto=on"));
    $manual = "${referer}${TestRunnerLocation}?" . join("&", array("test=" . $testPath . $testsuite, "resultsUrl=$resultsurl", "runInterval=$interval",));
    echo "<button onclick='window.open(" . '"' . $url . '"' . ")'>" . $lh->getText('Run test') . "</button>";
    $url.= "&extravars=$username,$pass,$lang";
    echo "<br />";
    echo "<a onclick='changeIt(\"linkcontainer\",\"<h3>AUTO:</h3><div>$url</div><h3>MANUAL:</h3> <div>$manual</div>\")' style='cursor: pointer;'>" . $lh->getText('Generate testlink') . "</a>";
    $newurl = str_replace("&", "--!!--", $url);
    //echo "<br /><a href='editCron.php?newurl=$newurl'>".$lh->getText('Plan test')."</a>";
    
}
?>
    
    <div id='linkcontainer'>
    </div>
  </body>
</html>
