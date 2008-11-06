<?php

class DirectoryNotFound extends Exception
{
	public function DirectoryNotFound($path)
	{
		$this->path = $path;
	}
	public function errorMessage()
	{
		//error message
		$errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
		.': <b>'.$this->getMessage().'</b> Because: The '. $this->path . ' was not found!';
		return $errorMsg;
	}
}

?>