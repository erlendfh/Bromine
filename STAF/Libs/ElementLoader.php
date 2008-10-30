<?php
include 'UiObject.php';
include 'Exceptions/ZeroElementsLoadedException.php';
include 'Exceptions/DirectoryNotFoundException.php';
include 'Exceptions/FileNameDoesNotMatchObjectNameException.php';

class ElementLoader
{
	// Define all vars to be used in the test!
	var $TIMEOUT = 15000;
	function loadElements($path, $language)
	{
		$path = '../../Elements/'.$path.'/';
		if(!file_exists($path)){throw new DirectoryNotFound($path);}
		//using the opendir function
		$dir_handle = opendir($path);

		//running the while loop
		while ($file = readdir($dir_handle))
		{
			if($file!="." && $file!=".."  && ( substr( $file, strlen( $file ) - strlen( '.xml') ) === '.xml' ))
			{

				$reader = new XMLReader();
				$reader->open($path.$file);
				//$arr = $this->parseXml($reader);
				$arr = $this->parseXml($reader);
				
				$name = $arr['element']['objectname'];
				
				if($file != $name .".xml"){throw new FileNameDoesNotMatchObjectNameException($file,$name);}
				
				$arr = $arr['element'];

				$this->{$name} = new UiObject($arr,$language);
				$i++;

			}
				

		}
		if ($i == 0){throw new ZeroElementsLoadedException();}
		//closing the directory
		closedir($dir_handle);

	}
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