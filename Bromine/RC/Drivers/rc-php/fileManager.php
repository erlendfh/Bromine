<?php
  class FileManager{
  
    private $file;
    
    function __construct($file){
      $this->file = $file;
    }
    
    function read(){
      $handle = fopen($this->file, "r") or die("can't open file");
      $contents = fread($handle, filesize($this->file));
      fclose($handle);
      return $contents;
    }
    
    function write($arr){
      $handle = fopen($this->file, 'w') or die("can't open file");
      fwrite($handle, $arr);
      fclose($handle);
    }
    
    function makeFile(){
      $handle = fopen($this->file, 'w') or die("can't open file");
      fclose($handle);
    }   
  }
?>
