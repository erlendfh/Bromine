<?php
function html_recursive($value) {
    if (is_array($value)) {
        foreach($value as $index => $val) {
            $value[$index] = html_recursive($val);
        }
        return $value;
    } else {
        return htmlspecialchars($value, ENT_QUOTES);
    }
}
$_GET = html_recursive($_GET);
$_POST = html_recursive($_POST);
$_COOKIE = html_recursive($_COOKIE);
$_REQUEST = html_recursive($_REQUEST);
?>
