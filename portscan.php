<?

function checkJavaServer($host, $port = 4444, $timeout=10){
  $fp = @fsockopen($host,$port,$errno,$errstr,$timeout);
  if($fp){
    fclose($fp);
    flush();
    return true;
  }
  else{
    flush();
    return $errstr;
  }
}

?> 
