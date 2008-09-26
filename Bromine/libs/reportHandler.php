<?php
//getSummary should be deleted and showreport should generate it
class reportHandler {
    public $dbh;
    public $result;
    public $s_id;
    public $suitename;
    public $environment;
    public $status;
    public $timeDate;
    public $timeTaken;
    public $browser;
    public $platform;
    public $selenium_version;
    public $selenium_revision;
    public $numTestPassed;
    public $numTestFailed;
    public $numCommandsPassed;
    public $numCommandsFailed;
    public $numCommandsErrors;
    public $numPassedMan;
    public $analysis;
    public $showPassed = true;
    public $showFailed = true;
    public $showNotDone = true;
    public $showDone = true;
    function __construct($id) {
        $this->dbh = new DBHandler($_SESSION['lang']);
        $result = $this->dbh->select('trm_suite, trm_browser, trm_os', "WHERE trm_suite.ID='$id' AND trm_suite.browser=trm_browser.ID AND trm_suite.platform=trm_os.ID", '*');
        $this->s_id = mysql_result($result, 0, "ID");
        //echo $this->s_id;
        $this->suitename = mysql_result($result, 0, "suitename");
        $this->environment = mysql_result($result, 0, "environment");
        $this->status = mysql_result($result, 0, "status");
        $this->timeDate = mysql_result($result, 0, "timeDate");
        $this->timeTaken = mysql_result($result, 0, "timeTaken");
        $this->browser = mysql_result($result, 0, "browsername");
        $this->platform = mysql_result($result, 0, "OSname");
        $this->selenium_version = mysql_result($result, 0, "selenium_version");
        $this->selenium_revision = mysql_result($result, 0, "selenium_revision");
        $this->numTestPassed = mysql_result($result, 0, "numTestPassed");
        $this->numTestFailed = mysql_result($result, 0, "numTestFailed");
        $this->numCommandsPassed = mysql_result($result, 0, "numCommandsPassed");
        $this->numCommandsFailed = mysql_result($result, 0, "numCommandsFailed");
        $this->numCommandsErrors = mysql_result($result, 0, "numCommandsErrors");
        $this->analysis = mysql_result($result, 0, "analysis");
        $result2 = $this->dbh->select('trm_test', "WHERE s_id='$id' AND manstatus='passed'", '*');
        $this->numPassedMan = mysql_numrows($result2);
    }
    function getSummary() {
        $html = $html . "<table>";
        $browser = $this->browser;
        $platform = $this->platform;
        $html = $html . "<tr><td>" . $this->dbh->getText('Client') . ":</td><td>" . $this->platform . " / " . $this->browser . "</td></tr>";
        $sec = $this->timeTaken;
        //$this->timeTaken
        $result = floor($sec/60);
        $tempTimeSec = $sec-(60*$result);
        $time = "$result " . $this->dbh->getText('min.') . " $tempTimeSec " . $this->dbh->getText('sec.');
        $html = $html . "<tr><td>" . $this->dbh->getText('Total time') . ":</td><td>" . $time . "</td></tr>";
        $html = $html . "<tr><td>" . $this->dbh->getText('Suite name') . ":</td><td>" . $this->suitename . "</td></tr>";
        $html = $html . "<tr>";
        $html = $html . "<td>" . $this->dbh->getText('Selenium version') . ": </td>";
        $html = $html . "<td>" . $this->selenium_version . "</td>";
        $html = $html . "</tr>";
        $html = $html . "<tr>";
        $html = $html . "<td>" . $this->dbh->getText('environment') . ": </td>";
        $html = $html . "<td>" . $this->environment . "</td>";
        $html = $html . "</tr>";
        $html = $html . "<tr>";
        $html = $html . "<td>" . $this->dbh->getText('Selenium version') . ": </td>";
        $html = $html . "<td>" . $this->selenium_revision . "</td>";
        $html = $html . "</tr>";
        $html = $html . "<tr>";
        $html = $html . "<td>" . $this->dbh->getText('Time') . "/" . $this->dbh->getText('Date') . ": </td>";
        $html = $html . "<td>" . $this->timeDate . "</td>";
        $html = $html . "</tr>";
        $html = $html . "<tr>";
        $html = $html . "<td>" . $this->dbh->getText('Test succeded') . ":</td><td style='background-color: #ccffcc'>" . $this->numTestPassed . "</td>";
        $html = $html . "</tr>";
        $html = $html . "<tr>";
        $html = $html . "<td>" . $this->dbh->getText('Test failed') . ":</td><td style='background-color: #ffcccc'>" . $this->numTestFailed . "</td>";
        $html = $html . "</tr>";
        $html = $html . "<tr>";
        $html = $html . "<td>" . $this->dbh->getText('Commands succeded') . ":</td><td style='background-color: #ccffcc'>" . $this->numCommandsPassed . "</td>";
        $html = $html . "</tr>";
        $html = $html . "<tr>";
        $html = $html . "<td>" . $this->dbh->getText('Commands failed') . ":</td><td style='background-color: #ffcccc'>" . $this->numCommandsFailed . "</td>";
        $html = $html . "</tr>";
        $html = $html . "<tr>";
        $html = $html . "<td>" . $this->dbh->getText('Commands not done') . ":</td><td style='background-color: yellow'>" . $this->numCommandsErrors . "</td>";
        $html = $html . "</tr>";
        $html = $html . "<tr>";
        $commandErrorPro = round($this->numCommandsFailed/($this->numCommandsErrors+$this->numCommandsFailed+$this->numCommandsPassed) *100, 2);
        $html = $html . "<td>" . $this->dbh->getText('Command Failures %') . ":</td><td style='background-color: #ffcccc'>" . $commandErrorPro . "%</td>";
        $html = $html . "</tr>";
        $html = $html . "</table>";
        return $html;
    }
    function get($var) { // BEGIN function get
        return $this->$var;
    } // END function get
    
}
?>
