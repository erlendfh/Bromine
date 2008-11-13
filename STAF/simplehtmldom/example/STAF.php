<?php
include('simple_html_dom.php');
 
// get DOM from URL or file

function lookup($type,$var,$value,$objectname)
{
    $html = file_get_html('http://www.krak.dk');
    //$find = $type.'['.$var.'='.$value.']';
    $findtype = 'input';
    //echo $find;
    
    $objectname = array('name','alt','title','value','id');
    
    foreach($html->find($findtype) as $e)
    {
        $i++;       
        $file = getcwd().'../'. $findtype . $i .'.xml';
        //echo $file;
        $h = fopen($file, 'w');
        fwrite($h, '<?xml version="1.0"?'.">\n");
        fwrite($h, "<element>\n");

        fwrite($h, "    <objecttype>$findtype</objecttype>\n");
        
        $foundName = false;
        $name = '';
        
        $arr = $e->getAllAttributes();
        foreach ( $arr as $key=>$value) 
        {
            if ($foundName == false){
                foreach ($objectname as $value2) {
                echo $value2." ";
                	if (array_key_exists($value2,$arr) && $foundName == false){
                        $name = $value;
                        echo " used af name!";
                        $foundName = true;
                        
                    }
                }
                }
                $value = htmlentities($value, ENT_NOQUOTES ,'UTF-8');
                fwrite($h, "    <$key>$value</$key>\n");

        	
        } 
        if ($name == ''){
            $name = $findtype . $i;
        }
        fwrite($h, "    <objectname>$name</objectname>\n");
        fwrite($h, "</element>\n");
        fclose($h);
        if ($foundName == true){
            rename("$findtype$i.xml","$name.xml");
        }
        
    
    }   
    //foreach($html->find('a') as $e)
    //    echo $e->innertext . '<br>';
            
}
/*
$type = $argv[1];
$var = $argv[2];
$value = $argv[3];
$objectname = $argv[4];
*/
lookup($type,$var,$value,$objectname);
?>