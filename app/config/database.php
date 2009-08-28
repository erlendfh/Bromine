<?php

class DATABASE_CONFIG {

	var $default = array(
		'driver' => 'mysql',
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'root',
		'password' => '',
		'database' => 'bromine',
		'prefix' => '',
	);

	/*
	function __construct() {

		#wildcard the subdomains
		$host_r = explode('.', $_SERVER['SERVER_NAME']);
		print_r($host_r);
		if(count($host_r)>2) while(count($host_r)>2)array_shift($host_r);
		$mainhost = implode('.', $host_r);

		#switch between servers
		
		switch(strtolower($mainhost)) {
			case 'localhost':
				$this->default = $this->local;
				break;
			case 'dev.com':
				$this->default = $this->dev;
				break;
			case 'live.com':
				$this->default = $this->live;
				break;
			default:
				$this->default = $this->local;
		}
		
	}

	#php 4 compatibility
	function DATABASE_CONFIG() {
		$this->__construct();
	}
*/

}
?>
