<?php

class ZeroElementsLoadedException extends Exception
{
	public function errorMessage()
	{
		//error message
		$errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
		.': <b>'.$this->getMessage().'</b> Because no elements was loaded!';
		return $errorMsg;
	}
}

?>