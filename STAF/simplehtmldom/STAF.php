<?php
include('simple_html_dom.php');
 
// get DOM from URL or file
$url = $_POST['url'];
$type = $_POST['type'];
$var = $_POST['var'];
$path = $_POST['path'];
$value = $_POST['value'];
$name = $_POST['name'];

function lookup($url, $type , $path ,$var = "",$value = "", $name = "")
{
    $html = file_get_html($url);
    
    if ($var == '' && $value == '')
    {
        $findtype = $type;
    }else{
        $findtype = $type.'['.$var.'='.$value.']';
    }
    
    $objectname = array('name','alt','title','id');
    
    foreach($html->find($findtype) as $e)
    {
        $i++;       
        @mkdir($path);
        $arr = $e->getAllAttributes();
        if ($name == '') {
        
        foreach ($objectname as $value) {
        	if (array_key_exists($value,$arr)){
                $name = $arr[$value];
                $foundName = true;
                break;
            }
        }
        }else{
            $foundName=true;
        }
        
        $file = getcwd(). "/$path/". $type . $i .'.xml';
        //echo $file;
        $h = fopen($file, 'w');
        
        fwrite($h, '<?xml version="1.0"?'.">\n");
        fwrite($h, "<!-- Loaded from: $url -->\n");
        fwrite($h, "<element>\n");
        

        fwrite($h, "    <objecttype>$type</objecttype>\n");
        foreach ($arr as $key=>$value) 
        {
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
            rename("$path/$type$i.xml","$path/$name.xml");
        }
        $name = '';
        $foundName = false;
    
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
lookup($url, $type , $path ,$var,$value, $name);
header('location: form.html');
?>