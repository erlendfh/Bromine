<?php
require_once("fileManager.php");

  class TextFileParser{
      private $fm;
      private $doSearch;
      private $type;
      private $description;
      
      function __construct($file, $p_name){
        $path = "../../rc-php/$p_name/data/".$file;
        $this->fm = new FileManager($path);        
      }
      
      function load(){
        $contents = $this->fm->read();     
        $find = explode("\n",$contents);
        $this->type = explode("=", $find[0]);
        $this->description = explode("=", $find[1]);
        $this->type = $this->type[1];
        $this->description = $this->description[1];
        unset($find[0]);
        unset($find[1]);
        $find = $this->array_trim($find);

        for($i = 0; $i < count($find); $i++){
          $tmp = explode(",",$find[$i]);
          $doSearch[] = $tmp;
        }
        $this->doSearch = $doSearch;
        return $this->doSearch;
      }
      
      function view(){
      $doSearch = $this->doSearch;
        for ( $row = 0; $row < count($doSearch); $row++ ){   
          for ( $column = 0; $column < count($doSearch[$row]); $column++ ){
            echo '|'.$doSearch[$row][$column];
          }
          echo '<br />';
        }
      }
      
      function array_trim($a){
        foreach($a as $value){
          $na[] = $value;
        }
        return $na;
      }
      
      function get($var){
        return $this->$var;
      }
}
?>
