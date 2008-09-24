<?php

class testBromineInstallation
{
    private $log = array();
    private $failed = false;
    
    function __construct()
    {
        $this->testForJava();
        $this->testForRuby();
        $this->testForPHP();
        $this->testForMaxExecutionTime();
        $this->testForMagicQoutes();
        $this->testForPermissions();
        
        //$this->showTestResult();
    }
    
    public function getResults(){
        $this->log['failed']=$this->failed;
        return $this->log;
    }
    
    function testForJava()
    {
        $this->log['test'][] = "Testing for java";
        exec('java -version', $output, $return);
        if ($return == 0)
        {
            $this->log['result'][] = "<span class='status_passed'>Java installed correctly</span>";
        }
        else
        {
            $this->log['result'][] = "<span class='status_failed'>Java not installed correctly! You need to add the java executable to your environment path, <a href='http://www.jibble.org/settingupjava.php'>See http://www.jibble.org/settingupjava.php</a></span>";
            $this->failed = true;
        }
    }
    
    function testForRuby()
    {
        $this->log['test'][] = "Testing for ruby";
        
        exec('ruby --version', $output, $return);
        if ($return == 0)
        {
            $this->log['result'][] = "<span class='status_passed'>Ruby installed correctly</span>";
        }
        else
        {
            $this->log['result'][] = "<span class='status_failed'>Ruby not installed correct! You need to add the ruby executable to your environment path, <a href='http://www.math.umd.edu/~dcarrera/ruby/0.3/install.html'>See http://www.math.umd.edu/~dcarrera/ruby/0.3/install.html</a></span>";
            $this->failed = true;
        }
    }
    
    function testForPHP()
    {
    
        $this->log['test'][] = "Testing for PHP";
        
        exec('php -version', $output, $return);
        
        if ($return == 0)
        {
            $this->log['result'][] = "<span class='status_passed'>PHP installed correctly</span>";
        }
        else
        {
            $this->log['result'][] = "<span class='status_failed'>PHP not installed correctly! You need to add the php executable to your environment path</span>";
            $this->failed = true;
        }
    
    }
    
    function testForMaxExecutionTime()
    {
        $this->log['test'][] = "Testing max executing time";
        if (ini_get("max_execution_time")>60000)
        {
            $this->log['result'][] = "<span class='status_passed'>Max executing time okay</span>";
        }
        else
        
        {
            $this->log['result'][] = "<span class='status_failed'>You need to manually set your max_execution_time in php.ini to a number higher than 60000</span>";
            $this->failed = true;
        }
    }
    
    function testForMagicQoutes()
    {
        $this->log['test'][] =  "Testing for magic quotes";
        if(get_magic_quotes_gpc())
        {
        	$this->log['result'][] =  "<span class='status_failed'>Magic quotes are enabled. You need to manually set magic_quotes_gpc = Off in php.ini</span>";
        	$this->failed = true;
        }
        else
        {
        	$this->log['result'][] =  "<span class='status_passed'>Magic quotes are disabled</span>";
        }
    }
    
    function testForPermissions()
    {
        $this->testPermission('.');
        $this->testPermission('RC');
        $this->testPermission('RC/rc-php');
        $this->testPermission('RC/rc-ruby');
        $this->testPermission('RC/rc-java');
        $this->testPermission('Attachments');
    }
    
    function testPermission($dir)
    {
    $dir=realpath($dir);
        $this->log['test'][] = "Testing permissions for $dir";
        if (is_writeable($dir) || @chmod($dir, 0777))
        {
            $this->log['result'][] = "<span class='status_passed'>$dir permissions are okay</span>";
        }
        else
        {
            $this->log['result'][] = "<span class='status_failed'>Write permissions needed for '$dir'</span>";
            $this->failed = true;
        
        }
    }
}
?>
