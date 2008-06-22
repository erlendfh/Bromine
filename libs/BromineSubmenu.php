<?php
/**
 * Renders a submenu for the menu
 */
class BromineSubmenu {
    private $id;
    private $pages;
    private $itemsPerRow;
    
    
    function __construct() {
        global $lh;
        $this->lh = $lh;
        $this->itemsPerRow = 6;
    }
    
    public function display() {
        $this->displayHeader();
        $this->displayBody();
        $this->displayFooter();
    }

    public function displayBody() {
        $count = 0;
        $url = '';
        $title = '';
        foreach($this->pages as $key => $page) {
            $count++;
            list($url, $title) = $page;
            $isActive = (basename($_SERVER['SCRIPT_NAME']) === $url) ? 'active' : '';

            echo "<td>";
            echo "<a class='{$this->id} $isActive' href='$url'>$title</a>";
            echo "</td>";
            if ($count === $this->itemsPerRow) {
                echo "</tr><tr>";
                $count = 0;
            }
        }
    }
    
    public function displayHeader() {
        echo "<table class='subMenu'><tr>";
    }
    public function displayFooter() {
        echo "</tr></table>";
    }
    
    public function projects(){
        $this->pages = array(
            'edit-projects' => array('editProjects.php', $this->lh->getText("Projects")), 
            'edit-hr' => array('editHR.php', $this->lh->getText("HR")), 
            'edit-requirements' => array('editRequirements.php', $this->lh->getText("Requirements"))
        );
        $this->id = 'projects';
    }
    
    public function testLab(){
        $this->pages = array(
            'testlab-testcases' => array('editTestCase.php', $this->lh->getText("Testcases")),
            'testlab-testplan' => array('editTestPlan.php', $this->lh->getText("Test Plan") ),
            'testlab-ftp' => array('simpleFTP.php', $this->lh->getText("Edit node tests")),
            'testlab-core-suites' => array('editCoreSuites.php', $this->lh->getText("Edit core suites")),
            'testlab-runner' => array('corerunner.php', $this->lh->getText("Testrunner core") ),
            'testlab-nodes' => array('genericRunner.php', $this->lh->getText("Testrunner nodes")),
            'testlab-manual-runner' => array('manualRunner.php', $this->lh->getText("Manual runner")),
            //'testlab-cron' => array('editCron.php', $lh->getText('Schedule tests')),
        );
        $this->id = 'testLab';
        $this->itemsPerRow = 4;
    }
    
    public function testResultManager(){
        $this->pages = array(
            'trm-raw' => array('main.php', $this->lh->getText("Raw data")), 
            'trm-analysis' => array('analysis.php', $this->lh->getText("Analysis")), 
            'trm-reqs' => array('showReqs.php', $this->lh->getText("Show requirements")), 
            'trm-defects' => array('showDefects.php', $this->lh->getText("Show defects")),
        );
        $this->id = 'testResultManager';
    }
    
    public function admin(){
        $this->pages = array(
            'admin-users' => array('editUsers.php', $this->lh->getText("Edit users")), 
            'admin-core-sites' => array('editSites.php', $this->lh->getText("Edit core sites")), 
            'admin-nodes' => array('editNodes.php', $this->lh->getText("Edit nodes")), 
            'admin-misc' => array('editMisc.php', $this->lh->getText("Edit misc")),
            'admin-usertype-access' => array('editUserTypeAccess.php', $this->lh->getText("Edit usertype access"))
        );
        $this->id = 'admin';
    }

}
