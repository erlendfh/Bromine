<?php
// Include the class loader that automatic load class to be used!
include 'ClassLoader.php';

/*
 * Class ElementLoader loads html-elements in XML formats into the framework!
 */
class ElementLoader
{
	// Define all vars to be used in the test!
	var $TIMEOUT = 30000;
	
	/*
	 * function loadElements load html-element from a specific path and in a language. This requires the correct setup 
	 * in the XML file. e.g. 
	 * <value-en>Google search</value-en>
	 * <value-dk>Google søgning</value-dk>
	 * 
	 * Same attribute but in two different languages
	 * @path - the name of the dir containing the elements
	 * @language - the language code used in the different elements, e.g. en, dk, de or es.  
	 */
	function loadElements($path, $language)
	{
		//Find the real location of the dir containing the elements
		$path = '../../Elements/'.$path.'/';
		
		//Check if the dir exists!
		if(!file_exists($path)){throw new DirectoryNotFound($path);}
		
		//using the opendir function
		$dir_handle = opendir($path);

		//running the while loop
		while ($file = readdir($dir_handle))
		{
			//Checks if != '.' || '..' && that it ends with '.xml', so it only load xml files
			if($file!="." && $file!=".."  && ( substr( $file, strlen( $file ) - strlen( '.xml') ) === '.xml' ))
			{
				//Create PHP XMLReader
				$reader = new XMLReader();
				
				//Open the XML for reading
				$reader->open($path.$file);
				//Parse the XML file into an array
				$arr = $this->parseXml($reader);
				
				//get the name that your shall use in the test script!
				$name = $arr['element']['objectname'];
				
				//Uncomment this if you want to assure that filename and objectname in xml are the same
				//if($file != $name .".xml"){throw new FileNameDoesNotMatchObjectNameException($file,$name);}
				
				//Parse the array to use it in the UiObject class
				$arr = $arr['element'];
				
				//Create new UiObject with the array from the XML file and the language you use
               
                
                $this->{$name} = new UiObject($arr,$language);
				
				$i++;

			}
				

		}
		//If no elements are loaded throw Exception
		if ($i == 0){throw new ZeroElementsLoadedException();}
		//closing the directory
		closedir($dir_handle);
/*
				foreach ($arr as $key=>$value) {
    	           $arr[$key] = urldecode($value);
                }
*/
	}
	
	//I don't really know how it works, found it on the internet! Thanks to someone! :) 
	function parseXml($xml) {
		$assoc = null;
		while($xml->read()){
			switch ($xml->nodeType) {
				case XMLReader::END_ELEMENT: return $assoc;
				case XMLReader::ELEMENT:
					if(!isset($assoc[$xml->name])) {
						if($xml->hasAttributes) {
							$assoc[$xml->name][] = $xml->isEmptyElement ? '' : parseXml($xml);
						} else {
							if($xml->isEmptyElement) {
								$assoc[$xml->name] = '';
							} else {
								$assoc[$xml->name] = $this->parseXml($xml);
							}
						}
					} elseif (is_array($assoc[$xml->name])) {
						if($xml->hasAttributes) {
							$assoc[$xml->name][] = $xml->isEmptyElement ? '' : parseXml($xml);
						} else {
							if($xml->isEmptyElement) {
								$assoc[$xml->name][] = '';
							} else {
								$assoc[$xml->name][] = parseXml($xml);
							}
						}
					} else {
						$mOldVar = $assoc[$xml->name];
						$assoc[$xml->name] = array($mOldVar);
						if($xml->hasAttributes) {
							$assoc[$xml->name][] = $xml->isEmptyElement ? '' : parseXml($xml);
						} else {
							if($xml->isEmptyElement) {
								$assoc[$xml->name][] = '';
							} else {
								$assoc[$xml->name][] = parseXml($xml);
							}
						}
					}
					if($xml->hasAttributes){
						$el =& $assoc[$xml->name][count($assoc[$xml->name]) - 1];
						while($xml->moveToNextAttribute()) {
							$el[$xml->name] = $xml->value;
						}
					}
					break;
				case XMLReader::TEXT:
				case XMLReader::CDATA: $assoc .= $xml->value;
			}
		}
		return $assoc;
	}
}
?>