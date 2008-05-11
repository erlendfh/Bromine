<?php 
  
  class DBHandler{
    
    var $db;
    var $username;
    var $database;
    var $password;
    var $host;
    var $lang;
    
    public $query;
    
    function __construct($l = 'en'){
    
      require('config.php');
      
      $this->lang=$l;
    	$this->db=mysql_connect($this->host, $this->username, $this->password);
    	mysql_select_db($this->database, $this->db);
    }
    
    function sql($sql)
    {
    	$this->query = $sql;
    	$result = mysql_query($this->query) or die (mysql_error());
    	//echo $this->query."<br />";
      if(strpos($sql,'REPLACE')!==false || strpos($sql,'INSERT')!==false){
        return mysql_insert_id();
      }else{
        return $result;
      }
    }
    
    function select($tableName, $condition, $data)
    {
    	$this->query = "SELECT $data FROM $tableName $condition";
    	//echo $this->query."<br /><br />";
    	$result = mysql_query($this->query) or die (mysql_error());
      return $result;
    }
    
    function insert($tableName, $values, $column)
    {
    	$this->query = "
        INSERT INTO $tableName ($column) 
        VALUES ($values)";
      //echo $this->query."<br />";
    	$result = mysql_query($this->query) or die (mysql_error());
    	return mysql_insert_id();
    }
    
    function update($tableName, $values, $condition)
    { 

    	$this->query = "
        UPDATE $tableName
        SET $values
        WHERE $condition";
        //echo $this->query."<br />";
    	$result = mysql_query($this->query) or die (mysql_error());
    	return $result;
    }
    
    function delete($tableName, $condition)
    {

    	$this->query = "
        DELETE FROM $tableName
        WHERE $condition";
        //echo $this->query."<br />";
    	$result = mysql_query($this->query) or die (mysql_error());
      return $result;
    }
    
    function getText($text)
    {
      $this->query = "SELECT $this->lang FROM TRM_lang WHERE langKey='$text'";
      //echo $this->query."<br />";
    	$result = mysql_query($this->query) or die (mysql_error());
    	$result = mysql_result($result,0,$lang);
    	return $result;
    }
    
    function disconnect(){
      mysql_close($this->db) or die (mysql_error());
    }
    
    function getdatabase(){
      return $this->database;
    }

  }
?>
