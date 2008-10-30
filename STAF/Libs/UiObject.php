<?php
/*
 * This class is a prototype of the STAF (Selenium Test Automation Framework)
 * This UIObject class simulates a control on a webpage(Button, input, img so on)
 */

class UiObject
{
	/*
	 * @var paramters is an array the class is called with
	 * it contains all the parameters of an UIOBject (ex. value, name, id, alt so on...)
	 */
	var $parameters;

	/*
	 * @var identifiers are used to decide what parameters of the UIObject is
	 * used make the UIObject indentifier(ex id='submit' and name='submit_button' and value = 'GO GO GO')
	 */
	var $identifiers = array('id','name','value','class');

	/*
	 * contructor for this class, called with $parameters
	 */

	function __construct($parameters, $language)
	{
		$this->parameters = $parameters;
		$this->language = $language;
	}

	/*
	 * getId() is used to create the UIObject identifier using the @var identifiers
	 */
	function getId()
	{
		$id = "//".$this->parameters['type']."[";
		foreach ($this->identifiers as $identifier)
		{
			if ($this->parameters[$identifier] != '')
			{
				$foundID = true;
				if ($firstID == true){$id .= " and ";}else{$firstID = true;}
				$id .= "@$identifier='".$this->parameters[$identifier]."'";
			}
		}

		$id .= "]";
		if ($foundID == false)
		{
			$id = $this->parameters['locator'];
		}

		return $id;

	}

	function getXpathWithVars($vars)
	{
		return $this->sprintf3($this->parameters['xpath'], $vars);
	}

	function getLink($index)
	{
		$id = $this->getIdentifier();
		$id .= "[$index]".$this->parameters['link'];
		return $id;
	}

	function getAttribute($attribute)
	{
			
		$key = $attribute . '-' . $this->language;
		if (array_key_exists($key, $this->parameters) == true)
		{
			return $this->parameters[$key];
		}
		else
		{
			return $this->parameters[$attribute];
		}

	}

	function sprintf2($str, $vars, $char = '%')
	{
		if(is_array($vars))
		{

			foreach($vars as $k => $v)
			{
				$str = str_replace($char . $k, $v, $str);
			}
		}

		return $str;
	}

	function sprintf3($str, $vars, $char = '%')
	{
		$tmp = array();
		foreach($vars as $k => $v)
		{
			$tmp[$char . $k . $char] = $v;
		}
		return str_replace(array_keys($tmp), array_values($tmp), $str);
	}
}


?>