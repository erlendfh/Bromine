<?php include ('protected.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
  	<?php include ('header.php'); ?>
  	<link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
    <?php include ('menu.php') ?>
    <?php
include ('testlabSubMenu.php');
$p_id = $_SESSION['p_id'];
$td_id = $_GET['td_id'];
if ($td_id == '') {
    $td_id = 0;
}
?>
    
    <?php
if ($p_id != '') {
    $td_id = $_GET['td_id'];
    $result1 = $dbh->select('TRM_design_manual_test', join(" ", array("WHERE p_id=$p_id", "ORDER BY name")), '*');
    echo "<p>" . $lh->getText('Edit') . "</p> ";
    echo "<form action='' method='get' style='display: inline;'>";
    echo "<p><select name='td_id' onchange='this.form.submit()'>";
    echo "<option value=''>" . $lh->getText('Choose') . "</option>";
    $a = 0;
    while ($row = mysql_fetch_array($result1)) {
        echo "<option value='" . $row['id'] . "' ";
        if ($row['id'] == $td_id) {
            echo "selected='selected'";
        }
        echo ">" . ($a+1) . ": " . $row['name'] . "</option>";
        $a++;
    }
    echo "</select>";
    echo "</p>";
    echo "</form> ";
    echo "<p>" . $lh->getText('or') . "</p> ";
    echo "<p><button onclick='window.location.href=" . '"' . "?td_id=new" . '"' . "'>" . $lh->getText('Add new') . "</button></p>";
    if ($td_id != '') {
        $result = $dbh->select('TRM_design_manual_test as test', join(" ", array("WHERE test.id='$td_id'", "ORDER BY test.name")), 'test.name as name, test.Description as Description');
        while ($row = mysql_fetch_array($result)) {
            $t_name = $row['name'];
            $t_description = $row['Description'];
        }
        $result = $dbh->select('TRM_design_manual_commands as commands, TRM_design_manual_test as test', join(" ", array("WHERE commands.td_id='$td_id' ", "AND test.id='$td_id' ", "AND test.p_id = $p_id ", "ORDER BY orderby ASC")), join(", ", array("commands.id as cd_id", "commands.action as action", "commands.reaction as reaction", "commands.id as id", "commands.orderby as orderby")));
        while ($row = mysql_fetch_array($result)) {
            $action[] = $row['action'];
            $reaction[] = $row['reaction'];
            $id[] = $row['id'];
            $order[] = $row['orderby'];
        }
        $confirm = '"' . $lh->getText('confirmDelete') . '"';
        echo "<form action='saveTestCase.php' method='post'>";
        echo "<h2>" . $lh->getText('Test name help') . "</h2>";
        echo "<table>";
        echo "<tr>";
        echo "<td colspan='3'>\n";
        echo " <input type='hidden' name='td_id' value='$td_id' />\n";
        echo $lh->getText('Name') . ": <input type='text' name='tc_name' value='$t_name' size='50'/>\n";
        echo "</td>\n";
        echo "<td><a href='delete.php?type=testCase&amp;id=$td_id&amp;back=editTestCase.php' onclick='return confirm($confirm)' ><img src='img/trashcan.gif' alt='" . $lh->getText('Delete') . "' /></a></td>\n";
        echo "</tr><tr><td>" . $lh->getText('Description') . ":<br /> <textarea name='tc_description' cols='65' rows='8'>$t_description</textarea></td></tr>";
        echo "</tr>";
        echo "<tr>";
        echo "</tr>";
        echo "</table><table>";
        echo "<th>Order by</th><th>" . $lh->getText('Action') . "</th><th>" . $lh->getText('Reaction') . "</th><th>" . $lh->getText('Delete') . "</th>";
        for ($i = 0;$i < count($action);$i++) {
            echo "<tr>";
            echo "<td>";
            echo "<select name='orderby[$id[$i]]'>";
            for ($a = 0;$a < count($order);$a++) {
                echo "<option";
                if ($order[$i] == $order[$a]) {
                    echo " selected=selected";
                }
                echo ">$order[$a]</option>";
            }
            echo "</select>";
            echo "</td>";
            echo "<td><textarea name='action[$id[$i]]' cols='20' rows='6'>" . $action[$i] . "</textarea></td>";
            echo "<td><textarea name='reaction[$id[$i]]' cols='20' rows='6'>" . $reaction[$i] . "</textarea></td>";
            echo "<td><a href='delete.php?type=testCaseStep&amp;id=$id[$i]&amp;back=editTestCase.php?td_id=$td_id' onclick='return confirm($confirm)' ><img src='img/trashcan.gif' alt='" . $lh->getText('Delete') . "' /></a></td>";
            echo "</tr>";
        }
        echo "<tr>";
        echo "<td colspan='2' id='addnew'>" . $lh->getText('Add new') . "</td>";
        echo "</tr>";
        echo "<tr>";
        echo "<td>";
        echo "<select name='neworderby'>";
        $neworder = 1+$order[count($order) -1];
        for ($a = 0;$a < count($order);$a++) {
            echo "<option";
            echo ">$order[$a]</option>";
        }
        echo "<option selected=selected>$neworder</option>";
        echo "</select>";
        echo "<input type='hidden' value='$neworder' name='should_be_neworderby'/>";
        echo "</td>";
        //echo "<td>";
        //echo "<input type='text' value='$neworder' size='3' name='neworderby' readonly/></td>";
        echo "<td>";
        echo "<textarea name='newaction' cols='20' rows='6'></textarea>";
        echo "</td>";
        echo "<td>";
        echo "<textarea name='newreaction' cols='20' rows='6'></textarea>";
        echo "</td>";
        echo "</tr>";
        echo "</table>";
        echo "<div><input type='submit' value='" . $lh->getText('Save') . "' /></div>";
        echo "</form>";
    }
}
?>

  </body>
</html>
