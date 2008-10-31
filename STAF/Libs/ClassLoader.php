<?php
/**
 * Simple __autoload implementation.
 */
class ClassLoader {
	/**
	 * Class autoloader, which finds classes in libs/ first,
	 * then falls back to classname.class.php in the root folder.
	 *
	 * @param string className
	 */

	

	public static function autoload($className) {
		 
		$dirs = array('Libs/','Libs/Exceptions/','Selenium/','Selenium/Exceptions/');
		
		foreach ($dirs as $dir)
		{
			
			
			if (is_file('../../'.$dir . $className . '.php')) {
				echo $dir;
				// Graph lives in libs/Graph.php
				require $dir . $className . '.php';
			}
		}

	}
}
spl_autoload_register(array('ClassLoader', 'autoload'));

