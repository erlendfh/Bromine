<?php
    require_once 'libs/DBHandler.php';
    require_once('error_reporting.php'); 
    class Suite{
      
        function __construct($name = "AUTONAME: Test Suite"){
            $this->dbh = new DBHandler($_GET['lang']);
            $this->name = $name;
            $this->environment = $_GET['sitetotest'];
            $this->browser = $_GET['browser'];
            $this->b_id = $_GET['b_id'];
            $this->platform = $_GET['o_id'];
            $this->p_id = $_GET['p_id'];
            $this->time=time();
        }
            
        function get($var){
            return $this->$var;
        }
        
        function getTime(){
            $sec = time() - $this->time;
            return $sec;
        }
    
        function createSuite($suitename, $sitetotest, $browser, $platform, $type, $p_id){
            global $dbh;
            $this->s_id=$dbh->insert('trm_suite',
            "
            NULL,  
            '$suitename',
            '$sitetotest',
            '',
            '".date('Y-m-d H:i:s')."',
            '',
            '$browser',
            '$platform',
            'RC',
            '$type',
            '',
            '',
            '',
            '',
            '',
            '$p_id'"
            ,
            "
            ID,
            suitename,
            environment,
            status,
            timeDate,
            timeTaken,
            browser,
            platform,
            selenium_version,
            selenium_revision,
            numTestPassed,
            numTestFailed,
            numCommandsPassed,
            numCommandsFailed,
            numCommandsErrors,
            p_id
            "
            );
            return $this->s_id;
        }
      
        function finalizeSuite(){
            $t_passed=mysql_num_rows($this->dbh->sql("SELECT * FROM trm_test WHERE s_id='$this->s_id' AND status='passed'"));
            $t_failed=mysql_num_rows($this->dbh->sql("SELECT * FROM trm_test WHERE s_id='$this->s_id' AND status='failed'"));
                        
            $passed=mysql_num_rows($this->dbh->sql("SELECT * FROM trm_test, trm_commands WHERE trm_commands.t_id=trm_test.ID AND trm_test.s_id='$this->s_id' AND trm_commands.status='passed'"));
            $failed=mysql_num_rows($this->dbh->sql("SELECT * FROM trm_test, trm_commands WHERE trm_commands.t_id=trm_test.ID AND trm_test.s_id='$this->s_id' AND trm_commands.status='failed'"));
            $done=mysql_num_rows($this->dbh->sql("SELECT * FROM trm_test, trm_commands WHERE trm_commands.t_id=trm_test.ID AND trm_test.s_id='$this->s_id' AND trm_commands.status='done'"));
            
            $status='passed';
            if($failed>0){
                $status='failed';
            }
            
            $time = $this->getTime();

            $this->dbh->update('trm_suite',"
            timeTaken = '$time',
            status = '$status',
            numTestPassed = '$t_passed',
            numTestFailed = '$t_failed',
            numCommandsPassed = '$passed',
            numCommandsFailed = '$failed',
            numCommandsErrors = 0", "id = '$this->s_id'");

            return "Suite ".$this->name." ".$this->dbh->getText('Finalized')."<br />";
        }
    }
?>
