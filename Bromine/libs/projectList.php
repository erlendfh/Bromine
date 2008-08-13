<?php
include_once ('DBHandler.class.php');
class projectList {
    public $dbh;
    public $result;
    public $num;
    public $id;
    public $name;
    public $description;
    function __construct($id) {
        $this->dbh = new DBHandler();
        $result = $this->dbh->select("trm_projectlist", "WHERE userId = '$id'", "projectID");
        $this->num = mysql_numrows($result);
        //$numreports=mysql_numrows($result);
        if ($this->num > 0) {
            for ($a = 0;$a < $this->num;$a++) {
                $projectID = mysql_result($result, $a, "projectID");
                $result2 = $this->dbh->select('trm_suite', "WHERE p_id=$projectID", 'ID');
                $noOfSuites[$a] = mysql_numrows($result2);
                $result1 = $this->dbh->select("trm_projects", "WHERE ID = '$projectID'", "*");
                $this->id[$a] = mysql_result($result1, 0, "id");
                $this->name[$a] = mysql_result($result1, 0, "name");
                $this->description[$a] = mysql_result($result1, 0, "description");
            }
        }
    }
}
?>
