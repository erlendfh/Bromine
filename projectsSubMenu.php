<?php
$pages = array('editProjects.php', 'editHR.php', 'editRequirements.php');
$linktext = array('Projects', 'HR', 'Requirements');
$file = end(explode('/', $_SERVER['SCRIPT_FILENAME']));
$breakCount = 6;
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
    echo "<div style='background: rgb(176,196,222); font-family: verdana; font-weight: bold; height: 20px; cursor: pointer;'>";
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
