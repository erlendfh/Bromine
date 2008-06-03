<?php 
  
  class DBHandler{
    
    public $db;
    public $username;
    public $database;
    public $password;
    public $host;
    public $lang;
    
    public $query;
    
    function __construct($l = 'en'){
        //Enable this if PEAR is installed and you are having problems with TestRunnerRC.php not working.  
        //require($_SERVER['DOCUMENT_ROOT'].'/bromine/config.php');
        require('config.php');

        $this->lang = $l;
        $this->db=mysql_connect($this->host, $this->username, $this->password);
        mysql_select_db($this->database, $this->db);
    }
    
    /**
     * Queries database with given SQL statement.
     *
     * @param string $sql SQL statement
     * @return Resultset, or inserted ID.
     */
    function sql($sql)
    {
    	$this->query = $sql;
    	$result = mysql_query($this->query) or die (mysql_error());
      if(strpos($sql,'REPLACE')!==false || strpos($sql,'INSERT')!==false){
        return mysql_insert_id();
      }else{
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
    function select($tableName, $condition, $data)
    {
    	$this->query = "SELECT $data FROM $tableName $condition";
    	$result = mysql_query($this->query) or die (mysql_error());
      return $result;
    }
    
    function insert($tableName, $values, $column)
    {
    	$this->query = "INSERT INTO $tableName ($column) VALUES ($values)";
    	$result = mysql_query($this->query) or die (mysql_error());
    	return mysql_insert_id();
    }
    
    function update($tableName, $values, $condition)
    { 
    	$this->query = "UPDATE $tableName SET $values WHERE $condition";
    	$result = mysql_query($this->query) or die (mysql_error());
    	return $result;
    }
    
    function delete($tableName, $condition)
    {

    	$this->query = "
        DELETE FROM $tableName WHERE $condition";

    	$result = mysql_query($this->query) or die (mysql_error());
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
    function getText($text)
    {
      $this->query = "SELECT $this->lang FROM TRM_lang WHERE langKey='$text'";
    	$result = mysql_query($this->query) or die (mysql_error());
    	$result = mysql_result($result, 0, $this->lang);
    	return $result;
    }
    
    function disconnect(){
      mysql_close($this->db) or die (mysql_error());
    }
    
    function getdatabase(){
      return $this->database;
    }
    
    /**
    * Simple accessor, for debugging purposes
    *
    * @return string The SQL query statement
    */
    public function getQuery() {
        return $query;
    }

  }
?>
