<?php
include_once ('protected.php');
$dbh = new DBHandler();
$in = $GLOBALS['_POST'];
//print_r($in);
/*
Array
(
[test] => Array
(
[7] => t_air
[8] => t_zoom_and_pan
[6] => t_starting_point
)

[newtest] => Array
(
[7] => t_air
[6] =>
)

)
*/
$test = $in['test'];
$newtest = $in['newtest'];
if ($test != '') {
    foreach($test as $k => $v) {
        $dbh->update('TRM_ReqsTests', "t_name = '$v'", "ID = '$k'");
    }
}
if ($newtest != '') {
    foreach($newtest as $k => $v) {
        if ($v != '') {
            $dbh->insert('TRM_ReqsTests', "NULL,'$v','$k'", 'ID, t_name, r_id');
        }
    }
}
header('Location: editTestPlan.php');
?>
