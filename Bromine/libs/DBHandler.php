<?php
class DBHandler {
    private $db;
    private $lang;
    private $query;
    public $username;
    public $database;
    public $password;
    public $host;
    function __construct($language='en') {
        require (dirname(dirname(__FILE__)) . '/config.php');
        $this->lang = $language;
        $this->db = mysql_connect($this->host, $this->username, $this->password);
        mysql_select_db($this->database, $this->db);
    }
    /**
     * Queries database with given SQL statement.
     *
     * @param string $sql SQL statement
     * @return Resultset, or inserted ID.
     */
    function sql($sql) {
        $this->query = $sql;
        //echo $this->query."<br />";
        $result = mysql_query($this->query) or die(mysql_error());
        if (strpos($sql, 'REPLACE') !== false || strpos($sql, 'INSERT') !== false) {
            return mysql_insert_id();
        } else {
            return $result;
        }
    }
    /**
     * Queries database with given SQL statement.
     * Used to update the database as it should not die like the normal sql function
     *
     * @param string $sql SQL statement
     * @return Resultset, or inserted ID.
     */                        
    function updateDB($sql) {
        $this->query = $sql;
        $result = mysql_query($this->query);
        if (strpos($sql, 'REPLACE') !== false || strpos($sql, 'INSERT') !== false) {
            return mysql_insert_id();
        } else {
            return $result;
        }
    }
    /**
     * Thin wrapper around a SELECT statement.
     *
     * @param string $tableName Tablename in FROM clause.
     * @param string $condition Full WHERE condition, including the "WHERE" word.
     * @param string $data List of columns to include in resultset.
     * @return Resultset
     * @todo Refrain from die()'ing on database error.
     */
    function select($tableName, $condition, $data) {
        $this->query = "SELECT $data FROM $tableName $condition";
        //echo $this->query."<br />";
        $result = mysql_query($this->query) or die(mysql_error());
        return $result;
    }
    function insert($tableName, $values, $column) {
        $this->query = "INSERT INTO $tableName ($column) VALUES ($values)";
        //echo $this->query."<br />";
        $result = mysql_query($this->query) or die(mysql_error());
        return mysql_insert_id();
    }
    function update($tableName, $values, $condition) {
        $this->query = "UPDATE $tableName SET $values WHERE $condition";
        //echo $this->query."<br />";
        $result = mysql_query($this->query) or die(mysql_error());
        return $result;
    }
    function delete($tableName, $condition) {
        $this->query = "DELETE FROM $tableName WHERE $condition";
        //echo $this->query."<br />";
        $result = mysql_query($this->query) or die(mysql_error());
        return $result;
    }
    /**
     * Returns translation of given phrase, in current language.
     *
     * To be used with its own $lh (language handler) database connection.
     *
     * @param string $text String to translate from English to target language
     * @return Translated string
     */
    function getText($text) {
        $this->query = "SELECT $this->lang FROM TRM_lang WHERE langKey='$text'";
        $result = mysql_query($this->query) or die(mysql_error());
        $num = mysql_numrows($result);
        if($num>0){
            $result = mysql_result($result, 0, $this->lang);
        }else{
            error_log('Bromine was unable to find translation for [' . $text. ']');
            $result = $text;
        }
        return $result;
    }
    function disconnect() {
        mysql_close($this->db) or die(mysql_error());
    }

    /** Accessor for debugging */
    public function getDatabase() {
        return $this->database;
    }
    /**
     * Simple accessor, for debugging purposes
     *
     * @return string The SQL query statement
     */
    public function getQuery() {
        return $this->query;
    }
   /* Not working, for future implementation of AES encryption
    private function getPassword($user){
        return mysql_query("SELECT 'name', AES_DECRYPT(password,'1234567890') AS 'pwd' FROM trm_users WHERE name = '$user'");
    }
    
    function verifyUser($name, $pass){
        $result = $this->select('TRM_users',"WHERE name='$name' AND usertype > 2",'*');
        if(mysql_num_rows($result) == 0){
        	return false;
        }
        else{
        	$gPassword = $this->getPassword($user);
        	while($row = mysql_fetch_array($result)){
            	echo $row['name']. " - ". $row['password'];
            	echo "<br />";
            }
        	$gPassword = mysql_result($gPassword,0, 'pwd');
        	echo "PWD = ".$gPassword;
        	if($pass == $gPassword){
        		return $result;
        	}
        	else{
        		return false;
        	}
        }
    }*/
}
