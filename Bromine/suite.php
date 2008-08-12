<?php
    require_once 'libs/DBHandler.php'; 
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
            $this->s_id=$dbh->insert('TRM_suite',
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
            $t_passed=mysql_num_rows($this->dbh->sql("SELECT * FROM TRM_test WHERE s_id='$this->s_id' AND status='passed'"));
            $t_failed=mysql_num_rows($this->dbh->sql("SELECT * FROM TRM_test WHERE s_id='$this->s_id' AND status='failed'"));
                        
            $passed=mysql_num_rows($this->dbh->sql("SELECT * FROM TRM_test, TRM_commands WHERE TRM_commands.t_id=TRM_test.ID AND TRM_test.s_id='$this->s_id' AND TRM_commands.status='passed'"));
            $failed=mysql_num_rows($this->dbh->sql("SELECT * FROM TRM_test, TRM_commands WHERE TRM_commands.t_id=TRM_test.ID AND TRM_test.s_id='$this->s_id' AND TRM_commands.status='failed'"));
            $done=mysql_num_rows($this->dbh->sql("SELECT * FROM TRM_test, TRM_commands WHERE TRM_commands.t_id=TRM_test.ID AND TRM_test.s_id='$this->s_id' AND TRM_commands.status='done'"));
            
            $status='passed';
            if($failed>0){
                $status='failed';
            }
            
            $time = $this->getTime();

            $this->dbh->update('TRM_suite',"
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
