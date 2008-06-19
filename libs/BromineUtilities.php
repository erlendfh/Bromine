<?php
/**
 * Utility class for name-spacing simple helper functions.
 */
class BromineUtilities {
    /**
     * Returns $array[$key], or $default.
     *
     * @param string $key
     * @param array $array
     * @param mixed $default
     * @return mixed
     */
    public static function arrayGet($key, $array, $default = '') {
        return array_key_exists($key, $array) ? $array[$key] : $default;
    }
    /**
     * You could call this htmlspecialchars_deep.
     *
     * @param array|string $value
     * @return mixed
     */
    public static function html_recursive($value) {
        if (is_array($value)) {
            foreach($value as $index => $val) {
                $value[$index] = self::html_recursive($val);
            }
            return $value;
        } else {
            return htmlspecialchars($value, ENT_QUOTES);
        }
    }
    public static function checkJavaServer($host, $port = 4444, $timeout = 10) {
        $fp = @fsockopen($host, $port, $errno, $errstr, $timeout);
        if ($fp) {
            fclose($fp);
            flush();
            return true;
        } else {
            flush();
            return $errstr;
        }
    }
}
