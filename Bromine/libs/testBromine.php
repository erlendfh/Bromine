<?php

class testBromineInstallation
{
    private $log = array();
    
    function __construct()
    {
        $this->testForJava();
        $this->testForRuby();
        $this->testForPHP();
        $this->testForMaxExecutionTime();
        $this->testForMagicQoutes();
        $this->testForPermissions();
        $this->showTestResult();
    }
    
    function testForJava()
    {
        $this->log[] = "Testing for java...";
        exec('java -version', $output, $return);
        if ($return == 0)
        {
            $this->log[] = "<span class='status_passed'>Java installed correct!</span>";
        }
        else
        {
            $this->log[] = "<span class='status_failed'>Java not installed correct! You need to add it to your environmental path, <a href='http://www.jibble.org/settingupjava.php'>See http://www.jibble.org/settingupjava.php</a></span>";
        }
    }
    
    function testForRuby()
    {
        $this->log[] = "Testing for ruby...";
        
        exec('ruby --version', $output, $return);
        if ($return == 0)
        {
            $this->log[] = "<span class='status_passed'>Ruby installed correct!</span>";
        }
        else
        {
            $this->log[] = "<span class='status_failed'>Ruby not installed correct! You may need to add it to your environmental path, <a href='http://www.math.umd.edu/~dcarrera/ruby/0.3/install.html'>See http://www.math.umd.edu/~dcarrera/ruby/0.3/install.html</a></span>";
        }
    }
    
    function testForPHP()
    {
    
        $this->log[] = "Testing for PHP...";
        
        exec('php -version', $output, $return);
        
        if ($return == 0)
        {
            $this->log[] = "<span class='status_passed'>PHP installed correct!</span>";
        }
        else
        {
            $this->log[] = "<span class='status_failed'>PHP not installed correct! You need to add it to your environmental path</span>";
        }
    
    }
    
    function testForMaxExecutionTime()
    {
        $this->log[] = "Testing max executing time...";
        if (ini_get("max_execution_time")>60000)
        {
            $this->log[] = "<span class='status_passed'>Max executing time okay!</span>";
        }
        else
        
        {
            $this->log[] = "<span class='status_failed'>You need to manually set your max_execution_time in php.ini to a number higher than 60000 else your test will not be able to run for more then 1 minute!</span>";
        }
    }
    
    function testForMagicQoutes()
    {
        $this->log[] =  "Testing for magic quotes...";
        if(get_magic_quotes_gpc())
        {
        	$this->log[] =  "<span class='status_failed'>Magic quotes are enabled</span>";
        }
        else
        {
        	$this->log[] =  "<span class='status_passed'>Magic quotes are disabled</span>";
        }
    }
    
    function testForPermissions()
    {
        $this->testPermission('RC');
        $this->testPermission('RC/rc-php');
        $this->testPermission('RC/rc-ruby');
        $this->testPermission('RC/rc-java');
        $this->testPermission('Attachments');
    }
    
    function testPermission($dir)
    {
        $this->log[] = "Testing permissions for $dir...";
        if (@chmod($dir, 0777) == true)
        {
            $this->log[] = "<span class='status_passed'>Permission are okay</span>";
        }
        else
        {
            $this->log[] = "<span class='status_failed'>Permission are not okay. Change Permission for '$dir' dir</span>";
        
        }
    }
    
    function showTestResult()
    {
        foreach ($this->log as $line)
        {
            
            if ($this->custom_modulo($i,2) == 0){echo "<br />";} 
            echo $line;
            $i++;
        }
    }
    
    function custom_modulo($var1, $var2) {
        $tmp = $var1/$var2;
        return (float) ( $var1 - ( ( (int) ($tmp) ) * $var2 ) );
    }


}

$b = new testBromineInstallation();
?>