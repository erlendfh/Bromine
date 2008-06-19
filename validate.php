<?php
/**
 * Ajax-invoked page that visits W3 validator services, and returns a HTML link,
 * colored green for valid, and pink for invalid.
 *
 * Querystring parameters
 *     type (required): 'xhtml'|'css'
 *     self: a URL to test
 */
if (!array_key_exists('self', $_GET)) {
    $self = $_SERVER['HTTP_REFERER'];
} else {
    $self = $_GET['self'];
}
if (!array_key_exists('type', $_GET)) {
    exit();
}
$type = $_GET['type'];
switch ($type) {
    case 'xhtml':
        $url = "http://validator.w3.org/check?uri=$self";
    break;
    case 'css':
        $url = "http://jigsaw.w3.org/css-validator/validator?uri=$self";
    break;
    default:
        exit;
}
$color = 'white';
try {
    if ($response = @file_get_contents($url)) {
        $color = 'pink';
        if (strpos($response, "This Page Is Valid") !== false || strpos($response, "Congratulations! No Error Found") !== false) {
            $color = 'lightgreen';
        }
    }
}
catch(Exception $e) {
    // nop
    
}
echo "<a href='$url' style='background-color: $color;'>$type</a>";
