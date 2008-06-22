<table class='menu'>
    <tr>
        <td colspan="4">
            <form method='get' action='' id='p_id_form' style='display: inline;'>
            <?php
                $get = BromineUtilities::arrayGet('get', $_GET);
                if ($get != '' && $get != 'nogo') {
                    $get = explode(',', $get);
                    $_SESSION['p_id'] = $get[0];
                    $_SESSION['p_name'] = $get[1];
                    $_SESSION["suitename"] = $lh->getText('All');
                    $_SESSION["environment"] = $lh->getText('All');
                    $_SESSION["platform"] = $lh->getText('All');
                    $_SESSION["browser"] = $lh->getText('All');
                    $_SESSION["timeDate1"] = $lh->getText('yyyy-mm-dd');
                    $_SESSION["timeDate2"] = $lh->getText('yyyy-mm-dd');
                }
                $dbh = new DBHandler();
                if ($sitename == 'editHR.php' || $sitename == 'projectsindex.php' || $sitename == 'editProjects.php') {
                    $result = $dbh->select('TRM_projects', "ORDER BY name", "*");
                } else {
                    $result = $dbh->select('TRM_projects, TRM_projectList', "WHERE TRM_projectList.userId = '" . $_SESSION['id'] . "' AND TRM_projectList.access='1' AND TRM_projectList.projectID=TRM_projects.ID ORDER BY TRM_projects.name", "TRM_projects.*");
                }
                $notset = 1;
                $numreports = mysql_numrows($result);
                echo "<span>" . $lh->getText('Choose project') . ":</span> ";
                echo "<span>";
                echo "<select name='get' onchange='document.forms[" . '"' . "p_id_form" . '"' . "].submit()'>";
                echo "<option value='nogo' disabled='disabled'>" . $lh->getText('Choose project') . "</option>";
                for ($i = 0;$i < $numreports;$i++) {
                    $p_id = mysql_result($result, $i, "id");
                    $p_name = mysql_result($result, $i, "name");
                    echo "<option value='$p_id,$p_name'";
                    if ($_SESSION['p_id'] == $p_id) {
                        echo ' selected="selected"';
                        $notset = 0;
                    }
                    echo ">$p_name</option>";
                }
                echo "</select>";
                echo "</span>";
                if ($notset) {
                    $_SESSION['p_id'] = '';
                    $_SESSION['p_name'] = '';
                }
            ?>
            </form>
        </td>
        <td align='right'>
            <?php
                echo "<button onclick='window.location=" . '"' . "login.php?action=logout" . '"' . "' style='background-color: rgb(139,0,0); color: white;'>" . $lh->getText('log out') . "</button>";
            ?>
        </td>
    </tr> 
    <tr>
        <?php
            $mainSiteAreas = array(
                'home' => array('index.php', 'Home'),
                'projects' => array('projectsindex.php', 'Projects'), 
                'testLab' => array('testlabindex.php', 'Test Lab'),
                'testResultManager' => array('TRMindex.php', 'Test Result Manager'),
                'admin' => array('adminindex.php', 'Link to admin-site'),
            );
            
            foreach ($mainSiteAreas as $key => $page) {
                echo "
                <td>
                    <a class='$key' href='{$page[0]}'>".$lh->getText($page[1])."</a>
                </td>";
            }
        ?>
    </tr>
</table>
