<?php
class FileNameDoesNotMatchObjectNameException extends Exception
 {
 	function __construct($file,$name)
 	{
 		$this->file = $file;
 		$this->name = $name;
 	}
 public function errorMessage()
  {
  //error message
  if ($this->name=='')$this->name = "<<empty>>"; 
  $errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
  .': <b>'.$this->getMessage().'</b> File name: '.$this->file.' does not match objectname node '.$this->name;
  return $errorMsg;
  }
 }
 ?>