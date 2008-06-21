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
    <?php include ('menu.php') ?>
    <?php include ('testlabSubMenu.php') ?>
    <?php //include('portscan.php')

?>
    <?php
$p_id = $_SESSION['p_id'];
$p_name = $_SESSION['p_name'];
$user = $_SESSION['user'];
$pass = $_SESSION['pass'];
$lang = $_SESSION['lang'];
if ($p_id != '') {
    $typeresult = $dbh->select('TRM_types', '', '*');
    while ($row = mysql_fetch_array($typeresult)) {
        $types[] = $row['typename'];
        $typesid[] = $row['ID'];
    }
    $noderesult = $dbh->select('TRM_nodes', "", "*");
    while ($row = mysql_fetch_array($noderesult)) {
        $nodes[] = $row['description'];
        $nodesid[] = $row['ID'];
        $nodepath[] = $row['nodepath'];
    }
    $siteresult = $dbh->select('TRM_projects_has_sites', "WHERE p_id=$p_id", "*");
    while ($row = mysql_fetch_array($siteresult)) {
        $sitetotests[] = $row['sitetotest'];
    }
    $u_id = $_SESSION['id'];
    $test = $_GET['tests'];
    $sitetotest = $_GET['sitetotest'];
    $b_id = $_GET['b_id'];
    $n_id = $_GET['n_id'];
    $OS_Browser = $_GET['OS_Browser'];
    $req = $_GET['req'];
    $suitename = $_GET['suitename'];
    if (is_array($_GET['tests'])) {
        $tests = $_GET['tests'];
    } else {
        $tests = array();
    }
?>
    <?php
    $result = $dbh->select('TRM_nodes', "", "*");
    $numreports = mysql_numrows($result);
    echo "<fieldset style='width: 600px;'>";
    echo "<legend>Node status</legend>";
    echo "<table>";
    echo "<tr  align='center'>";
    for ($i = 0;$i < $numreports;$i++) {
        $description = mysql_result($result, $i, "description");
        echo "<th>$description</th>";
    }
    echo "</tr>";
    echo "<tr  align='center'>";
    for ($i = 0;$i < $numreports;$i++) {
        $n_id = mysql_result($result, $i, "ID");
        $nodepath = mysql_result($result, $i, "nodepath");
        echo "<td><span id='span$n_id'></span></td>";
        echo "
            <script type='text/javascript'>
            new Ajax.Updater('span$n_id' ,'portscan.php', {
            method: 'get',
            parameters: {host: '$nodepath'}
            });
            </script>";
    }
    echo "</tr>";
    echo "</table>";
    echo "</fieldset>";
    echo "<br />";
?>
    <form method='get' action=''>
      <input type='hidden' name='which' value='reqdiv' />
      <fieldset style='width: 600px;'>
        <legend onclick="$('reqdiv').toggle()" style='cursor: pointer'>Test requirements</legend>
        <div id='reqdiv' style="display:none;">
          <table>
            
            <tr>
              <td>
                <?php echo $lh->getText('Requirement'); ?>
              </td>
              <td>
                <?php
    $outer_result = $dbh->select(" 
                  TRM_requirements, TRM_projectList", "WHERE TRM_requirements.p_id = '$p_id' AND
                  TRM_projectList.projectID=TRM_requirements.p_id AND
                  TRM_projectList.userID='$u_id' AND
                  TRM_projectList.access='1'", "*");
    $outer_num_row = mysql_numrows($outer_result);
    echo "<select name='req' onchange='this.form.submit()' ";
    echo ">";
    echo "<option value=''>" . $lh->getText('Choose') . "</option>";
    for ($i = 0;$i < $outer_num_row;$i++) {
        $r_id = mysql_result($outer_result, $i, "TRM_requirements.ID");
        $r_nr = mysql_result($outer_result, $i, "TRM_requirements.nr");
        $r_name = mysql_result($outer_result, $i, "TRM_requirements.name");
        echo "<option value='$r_id' ";
        if ($req == $r_id) {
            echo " selected='selected'";
        }
        echo ">" . $r_name . "</option>";
    }
    echo "</select>";
    $inner_result = $dbh->select(" 
                          TRM_requirements, TRM_ReqsTests", "WHERE TRM_requirements.ID = '$req' AND 
                          TRM_ReqsTests.r_id=TRM_requirements.id", "*");
    $inner_num_row = mysql_numrows($inner_result);
    for ($i = 0;$i < $inner_num_row;$i++) {
        $t_name = mysql_result($inner_result, $i, "t_name");
        echo "<input type='hidden' value='$t_name' name=tests[] />";
    }
    $suitename = "Requirement: " . @mysql_result($inner_result, 0, "TRM_requirements.name");
?>
              </td>
            </tr>
            <tr>
            <td>Vælg OS/Browser
            </td>
            <td>
            <?php
    $rresult = $dbh->select("TRM_ReqsOSBrows, TRM_OS, TRM_browser", "WHERE TRM_ReqsOSBrows.r_id = '$req' AND 
              TRM_OS.ID = TRM_ReqsOSBrows.o_id AND
              TRM_browser.ID = TRM_ReqsOSBrows.b_id", "*");
    $rnum_row = mysql_numrows($rresult);
    echo "<select name='OS_Browser' onchange='this.form.submit()'>";
    echo "<option value=''>Vælg</option>";
    for ($b = 0;$b < $rnum_row;$b++) {
        $OScur = mysql_result($rresult, $b, "OSname");
        $Browsercur = mysql_result($rresult, $b, "browsername");
        $browser_id = mysql_result($rresult, $b, "TRM_browser.ID");
        $os_id = mysql_result($rresult, $b, "TRM_OS.ID");
        $noderesult = $dbh->select('TRM_nodes', "WHERE o_id = $os_id", '*');
        $node_id = mysql_result($noderesult, 0, "ID");
        $nodepath = mysql_result($noderesult, 0, "TRM_nodes.nodepath");
        echo "<option value='$node_id,$browser_id' ";
        if ($_GET['OS_Browser'] == "$node_id,$browser_id") {
            echo " selected='selected'";
        }
        echo ">$OScur ";
        echo "@ $Browsercur</option>";
    }
    echo "</select>";
?>
            </td>
            </tr>
            <tr>
              <td><?php echo $lh->getText('Site to be tested'); ?></td>
              <td>
              <?php
    if ($test != '') {
        echo "<select name='sitetotest' onchange='this.form.submit()'>";
        echo "<option value=''>" . $lh->getText('Choose') . "</option>";
        foreach($sitetotests as $key => $site) {
            echo "<option value='$site'";
            if (urldecode($sitetotest) == $site) {
                echo " selected='selected'";
            }
            echo ">$site</option>";
        }
        echo "</select>";
    }
?>
              </td>
            </tr>
            <?php
    if (count($tests) > 0 && $sitetotest != '' && $OS_Browser != '') {
        echo "<tr>";
        echo "<td>";
        $noclosemsg = $lh->getText('noclosemsg');
        // HARDCODED!!!!!!!! //
        $type = 'rc-php';
        $lala = explode(',', $OS_Browser);
        $n_id = $lala[0];
        $b_id = $lala[1];
        $url = "testRunnerRC.php?test=genericSuite.php&type=$type&n_id=$n_id&b_id=$b_id&datafile=$datafile&user=$user&pass=$pass&p_id=$p_id&p_name=$p_name&sitetotest=$sitetotest&suitename=$suitename&lang=$lang";
        for ($i = 0;$i < count($test);$i++) {
            $url2.= "&tests[]=$test[$i]";
        }
        //$url2 = $url2;
        $url.= $url2;
        echo "<button id='runReq' onclick='window.open(" . '"' . $url . '"' . "); alert(" . '"' . $noclosemsg . '"' . ")'>" . $lh->getText('Run test') . "</button>";
        echo "</td>";
        echo "</tr>";
    }
?>
          </table>
        
          <?php
?>
             
      </div>
    </fieldset>
  </form>
  
  <?php $url2 = '' ?>
  <br /><br />
  
  
  <form method='get' action=''>
  <input type='hidden' name='which' value='multitest' />
    <fieldset style='width: 600px;'> 
      <legend onclick="$('multitest').toggle()" style='cursor: pointer'>Run tests</legend>
      <div id='multitest' style="display:none;">   
          <table>
            <tr>
              <td>
                <?php echo $lh->getText('Test'); ?>
              </td>
              <td>
                <?php
    $testcaseresult = $dbh->select('TRM_design_manual_test', "WHERE p_id=$p_id", "*");
    while ($row = mysql_fetch_array($testcaseresult)) {
        $testcasename = $row['name'];
        echo "<input type='checkbox' name='tests[]' value='$testcasename' ";
        if (!file_exists("RC/rc-php/$p_name/$testcasename.php")) {
            echo "disabled='disabled' ";
        } //HARDCODED!!!!!!!
        if (in_array($testcasename, $tests)) {
            echo "checked='checked'";
        }
        echo "onclick='this.form.submit()'/> $testcasename<br />";
    }
    $num_tests = mysql_num_rows($testcaseresult);
    if ($num_tests == 0) {
        echo $dbh->getText('No tests');
    }
?>
              </td>
            </tr>
            <tr>
            <td>Vælg OS/Browser
            </td>
            <td>
            <?php
    if (count($tests) > 0) {
        $rresult = $dbh->select("TRM_OS, TRM_browser, TRM_nodes_browsers, TRM_nodes", "WHERE TRM_nodes_browsers.n_id=TRM_nodes.id AND 
              TRM_nodes_browsers.b_id=TRM_browser.id AND
              TRM_OS.id=TRM_nodes.o_id", "*");
        $rnum_row = mysql_numrows($rresult);
        echo "<select name='OS_Browser' onchange='this.form.submit()'>";
        echo "<option value=''>Vælg</option>";
        for ($b = 0;$b < $rnum_row;$b++) {
            $OScur = mysql_result($rresult, $b, "OSname");
            $Browsercur = mysql_result($rresult, $b, "browsername");
            $browser_id = mysql_result($rresult, $b, "TRM_browser.ID");
            $os_id = mysql_result($rresult, $b, "TRM_OS.ID");
            $noderesult = $dbh->select('TRM_nodes', "WHERE o_id = $os_id", 'ID');
            $node_id = mysql_result($noderesult, 0, "ID");
            $node_description = mysql_result($rresult, $b, "TRM_nodes.description");
            $nodepath = mysql_result($rresult, $b, "TRM_nodes.nodepath");
            echo "<option value='$node_id,$browser_id' ";
            if ($_GET['OS_Browser'] == "$node_id,$browser_id") {
                echo " selected='selected'";
            }
            echo ">$node_description";
            echo " @ $Browsercur</option>";
        }
        echo "</select>";
    }
?>
            </td>
            </tr>
            <tr>
              <td><?php echo $lh->getText('Site to be tested'); ?></td>
              <td>
              <?php
    if (count($tests) > 0 && $OS_Browser != '') {
        echo "<select name='sitetotest' onchange='this.form.submit()'>";
        echo "<option value=''>" . $lh->getText('Choose') . "</option>";
        foreach($sitetotests as $key => $site) {
            echo "<option value='$site'";
            if (urldecode($sitetotest) == $site) {
                echo " selected='selected'";
            }
            echo ">$site</option>";
        }
        echo "</select>";
    }
?>
              </td>
            </tr>
            <tr>
              <td><?php echo $lh->getText('Suite name'); ?></td>
              <td>
              <?php
    if (count($tests) > 0 && $OS_Browser != '' && $sitetotest != '') {
        $suitename = 'multitest';
        if (isset($_GET['suitename'])) {
            $suitename = $_GET['suitename'];
        }
        echo "<input type='text' name='suitename' value='$suitename' onblur='this.form.submit()'/>";
    }
?>
              </td>
            </tr>
    
            <?php
    if (count($tests) > 0 && $sitetotest != '' && $OS_Browser != '') {
        //$ready=1;
        echo "<tr>";
        echo "<td>";
        $noclosemsg = $lh->getText('noclosemsg');
        // HARDKODED!!!!!!!! //
        $type = 'rc-php';
        $lala = explode(',', $OS_Browser);
        $n_id = $lala[0];
        $b_id = $lala[1];
        $url = "testRunnerRC.php?test=genericSuite.php&type=$type&n_id=$n_id&b_id=$b_id&datafile=$datafile&user=$user&pass=$pass&p_id=$p_id&p_name=$p_name&sitetotest=$sitetotest&suitename=$suitename&lang=$lang";
        for ($i = 0;$i < count($tests);$i++) {
            $url2.= "&tests[]=$tests[$i]";
        }
        //$url2 = urlencode($url2);
        $url.= $url2;
        echo "<button id='runMultiple' onclick='window.open(" . '"' . $url . '"' . "); alert(" . '"' . $noclosemsg . '"' . ")'>" . $lh->getText('Run test') . "</button>";
        echo "</td>";
        echo "</tr>";
    }
?>
        </table>
      </div>
    </fieldset>
  </form>
  <br />
  <br />
  
      <!--form method='get' action=''>
      <input type='hidden' name='which' value='reqdiv' />
      <fieldset style='width: 600px;'>
        <legend onclick="$('datatestdiv').toggle()" style='cursor: pointer'>Data test</legend>
        <div id='datatestdiv' style="display:none;">
          <table>
            VIRKER IKKE!!!!! Den er ikke lavet før vi er færdige med at flytte genericSuite osv.... VENT SLUT!
            <tr>
              <td>
                <?php echo $lh->getText('Requirement'); ?>
              </td>
              <td>
                <?php
    $outer_result = $dbh->select(" 
                  TRM_requirements, TRM_projectList", "WHERE TRM_requirements.p_id = '$p_id' AND
                  TRM_projectList.projectID=TRM_requirements.p_id AND
                  TRM_projectList.userID='$u_id' AND
                  TRM_projectList.access='1'", "*");
    $outer_num_row = mysql_numrows($outer_result);
    echo "<select name='req' onchange='this.form.submit()' ";
    echo ">";
    echo "<option value=''>" . $lh->getText('Choose') . "</option>";
    for ($i = 0;$i < $outer_num_row;$i++) {
        $r_id = mysql_result($outer_result, $i, "TRM_requirements.ID");
        $r_nr = mysql_result($outer_result, $i, "TRM_requirements.nr");
        $r_name = mysql_result($outer_result, $i, "TRM_requirements.name");
        echo "<option value='" . $r_id . "' ";
        if ($req == $r_id) {
            echo " selected='selected'";
        }
        echo ">" . $r_name . "</option>";
    }
    echo "</select>";
    $inner_result = $dbh->select(" 
                          TRM_requirements, TRM_ReqsTests", "WHERE TRM_requirements.ID = '$req' AND 
                          TRM_ReqsTests.r_id=TRM_requirements.id", "*");
    $inner_num_row = mysql_numrows($inner_result);
    for ($i = 0;$i < $inner_num_row;$i++) {
        $t_name = mysql_result($inner_result, $i, "t_name");
        echo "<input type='hidden' value='$t_name' name=tests[] />";
    }
    $suitename = @mysql_result($inner_result, 0, "TRM_requirements.name");
?>
              </td>
            </tr>
            <tr>
            <td>Vælg OS/Browser
            </td>
            <td>
            <?php
    $rresult = $dbh->select("TRM_ReqsOSBrows, TRM_OS, TRM_browser", "WHERE TRM_ReqsOSBrows.r_id = '$req' AND 
              TRM_OS.ID = TRM_ReqsOSBrows.o_id AND
              TRM_browser.ID = TRM_ReqsOSBrows.b_id", "*");
    $rnum_row = mysql_numrows($rresult);
    echo "<select name='OS_Browser' onchange='this.form.submit()'>";
    echo "<option value=''>Vælg</option>";
    for ($b = 0;$b < $rnum_row;$b++) {
        $OScur = mysql_result($rresult, $b, "OSname");
        $Browsercur = mysql_result($rresult, $b, "browsername");
        $browser_id = mysql_result($rresult, $b, "TRM_browser.ID");
        $os_id = mysql_result($rresult, $b, "TRM_OS.ID");
        $noderesult = $dbh->select('TRM_nodes', "WHERE o_id = $os_id", 'ID');
        $node_id = mysql_result($noderesult, 0, "ID");
        echo "<option value='$node_id,$browser_id' ";
        if ($_GET['OS_Browser'] == "$node_id,$browser_id") {
            echo " selected='selected'";
        }
        echo ">$OScur @ $Browsercur</option>";
    }
    echo "</select>";
?>
            </td>
            </tr>
            <tr>
              <td><?php echo $lh->getText('Site to be tested'); ?></td>
              <td>
              <?php
    if ($test != '') {
        echo "<select name='sitetotest' onchange='this.form.submit()'>";
        echo "<option value=''>" . $lh->getText('Choose') . "</option>";
        foreach($sitetotests as $key => $site) {
            echo "<option value='$site'";
            if (urldecode($sitetotest) == $site) {
                echo " selected='selected'";
            }
            echo ">$site</option>";
        }
        echo "</select>";
    }
?>
              </td>
            </tr>
            <?php
    if (count($tests) > 0 && $sitetotest != '' && $OS_Browser != '') {
        echo "<tr>";
        echo "<td>";
        $noclosemsg = $lh->getText('noclosemsg');
        $user = $_SESSION['user'];
        $pass = $_SESSION['pass'];
        // HARDKODED!!!!!!!! //
        $type = 'rc-php';
        $lala = explode(',', $OS_Browser);
        $n_id = $lala[0];
        $b_id = $lala[1];
        $url = "testRunnerRC.php?test=genericSuite.php&type=$type&n_id=$n_id&b_id=$b_id&datafile=$datafile&user=$user&pass=$pass&p_id=$p_id&p_name=$p_name&sitetotest=$sitetotest&suitename=$suitename";
        for ($i = 0;$i < count($test);$i++) {
            $url2.= "&tests[]=$test[$i]";
        }
        //$url2 = $url2;
        $url.= $url2;
        echo "<button id='runDataTest' onclick='window.open(" . '"' . $url . '"' . "); alert(" . '"' . $noclosemsg . '"' . ")'>" . $lh->getText('Run test') . "</button>";
        echo "</td>";
        echo "</tr>";
    }
?>
          </table>
        
          <?php
?>
             
      </div>
    </fieldset>
  </form-->
  
  <div id='linkcontainer'>
  </div>
  
  <?php
    if (array_key_exists('which', $_GET)) {
        echo "<script type='text/javascript'>$('{$_GET['which']}').toggle();</script>";
    }
}
?> 
  </body>
</html>
<?php
/*
if($ready){
echo "<br />";

$result = $dbh->select('TRM_users','WHERE ID=1','*');
$username=mysql_result($result,0,"name");
$pass=mysql_result($result,0,"password");

$lang=$_SESSION['lang'];

$url=$_SERVER['SERVER_NAME'].'/'.$url;

echo "<br />";
echo "<br />";

echo "<a onclick='changeIt(".'"'."linkcontainer".'"'.",".'"'.$url.'"'.")' style='cursor: pointer;'>".$lh->getText('Generate testlink')."</a>";
$newurl=str_replace("&", "--!!--", $url);
echo "<br /><a href='editCron.php?newurl=$newurl'>".$lh->getText('Plan test')."</a>";
}
*/
?>
