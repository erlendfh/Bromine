<?php

  if ($_GET['self'] == ''){
    $self=$_SERVER['HTTP_REFERER'];
  }else{
    $self=$_GET['self'];
  }
  $type=$_GET['type'];
  
  switch($type){
    case 'xhtml':
      $url="http://validator.w3.org/check?uri=$self";
      break;
    case 'css':
      $url="http://jigsaw.w3.org/css-validator/validator?uri=$self";
      break;
    default:
      exit;
  }
  
  $color='white';
  try{
    if($response=@file_get_contents($url)){
      $color='pink';
      if(strpos($response,"This Page Is Valid")!==false || strpos($response,"Congratulations! No Error Found")!==false){
        $color='lightgreen';
      }
    }
  } catch(Exception $e){}
  
  echo "<a href='$url' style='background-color: $color;'>$type</a>";
?>
