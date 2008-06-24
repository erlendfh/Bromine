<?php
/**
 * Renders a submenu for the menu
 */
class BromineSubmenu {
    private $id;
    private $pages;
    private $itemsPerRow;
    
    function __construct($id, array $pages, $itemsPerRow=6) {
        $this->pages = $pages;
        $this->id = $id;
        $this->itemsPerRow = $itemsPerRow;
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
    
    protected function displayHeader() {
        echo "<table class='subMenu'><tr>";
    }
    
    protected function displayFooter() {
        echo "</tr></table>";
    }

    public static function renderProjectsSubmenu() {
        global $lh;
        $pages = array(
            'edit-projects' => array('editProjects.php', $lh->getText("Projects")), 
            'edit-hr' => array('editHR.php', $lh->getText("HR")), 
            'edit-requirements' => array('editRequirements.php', $lh->getText("Requirements"))
        );
        $submenu = new BromineSubmenu('projects', $pages);
        $submenu->display();
    }
    
    public static function renderTestLabSubmenu() {
        global $lh;
        $pages = array(
            'testlab-testcases' => array('editTestCase.php', $lh->getText("Testcases")),
            'testlab-testplan' => array('editTestPlan.php', $lh->getText("Test Plan") ),
            'testlab-ftp' => array('simpleFTP.php', $lh->getText("Edit node tests")),
            'testlab-core-suites' => array('editCoreSuites.php', $lh->getText("Edit core suites")),
            'testlab-runner' => array('corerunner.php', $lh->getText("Testrunner core") ),
            'testlab-nodes' => array('genericRunner.php', $lh->getText("Testrunner nodes")),
            'testlab-manual-runner' => array('manualRunner.php', $lh->getText("Manual runner")),
            //'testlab-cron' => array('editCron.php', $lh->getText('Schedule tests')),
        );
        $submenu = new BromineSubmenu('testLab', $pages, 4);
        $submenu->display();
    }
    
    public static function renderTestResultManagerSubmenu() {
        global $lh;
        $pages = array(
            'trm-raw' => array('main.php', $lh->getText("Raw data")), 
            'trm-analysis' => array('analysis.php', $lh->getText("Analysis")), 
            'trm-reqs' => array('showReqs.php', $lh->getText("Show requirements")), 
            'trm-defects' => array('showDefects.php', $lh->getText("Show defects")),
        );
        $submenu = new BromineSubmenu('testResultManager', $pages);
        $submenu->display();
    }
    
    public static function renderAdminSubmenu() {
        global $lh;
        $pages = array(
            'admin-users' => array('editUsers.php', $lh->getText("Edit users")), 
            'admin-core-sites' => array('editSites.php', $lh->getText("Edit core sites")), 
            'admin-nodes' => array('editNodes.php', $lh->getText("Edit nodes")), 
            'admin-misc' => array('editMisc.php', $lh->getText("Edit misc")),
            'admin-usertype-access' => array('editUserTypeAccess.php', $lh->getText("Edit usertype access"))
        );
        $submenu = new BromineSubmenu('admin', $pages);
        $submenu->display();
    }
}
