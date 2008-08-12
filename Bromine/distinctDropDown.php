<?php
session_name('Bromine');
session_start();
function distinctDropDown($attribute, $projectID, $u = '', $analysis = 0) {
    $dbh = new DBHandler($_SESSION['lang']);
    $result = $dbh->select('TRM_suite', "WHERE p_id='$projectID' AND analysis='$analysis' ORDER BY timedate ASC", "DISTINCT $attribute");
    $numreports = mysql_numrows($result);
    echo "<select name='$attribute$u'>";
    echo "<option>" . $dbh->getText('All') . "</option>";
    for ($i = 0;$i < $numreports;$i++) {
        echo "<option ";
        if ($_SESSION["$attribute$u"] == mysql_result($result, $i, "$attribute")) {
            echo 'selected="selected"';
        }
        if ($attribute != 'browser' && $attribute != 'platform') {
            echo ">" . mysql_result($result, $i, "$attribute") . "</option>";
        } elseif ($attribute == 'browser') {
            $b_id = mysql_result($result, $i, "$attribute");
            if ($b_id != '') {
                $b_result = $dbh->sql("SELECT * FROM TRM_browser WHERE ID = $b_id");
                echo "value = '$b_id'>" . mysql_result($b_result, 0, "browsername") . "</option>";
            }
        } elseif ($attribute == 'platform') {
            $p_id = mysql_result($result, $i, "$attribute");
            //echo $p_id."<br />".mysql_result($b_result,0,"OSname");
            if ($p_id != '') {
                $b_result = $dbh->sql("SELECT * FROM TRM_OS WHERE ID = $p_id");
                echo "value = '$p_id'>" . mysql_result($b_result, 0, "OSname") . "</option>";
            }
        }
    }
    echo "</select>";
}
?>
