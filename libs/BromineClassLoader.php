<?php
/**
 * Simple __autoload implementation.
 */
class BromineClassLoader {
    /**
     * Class autoloader, which finds classes in libs/ first,
     * then falls back to classname.class.php in the root folder.
     *
     * @param string className
     */
    public static function autoload($className) {
        if (is_file('libs/' . $className . '.php')) {
            // Graph lives in libs/Graph.php
            require 'libs/' . $className . '.php';
        } elseif (is_file(strtolower($className) . 'class.php')) {
            // Graph lives in graph.class.php
            require strtolower($className) . 'class.php';
        }
    }
}
spl_autoload_register(array('BromineClassLoader', 'autoload'));
