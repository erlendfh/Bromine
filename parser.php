<?php

  $dbh=new DBHandler();
  
  function between($beg, $end, $str, $multiple=true) {
    $a = explode($beg, substr($str,strpos($str,$beg)+strlen($beg)));
    for($i=0;$i<count($a);$i++){
      if(substr($a[$i],0,strpos($a[$i],$end))!=false){
        $b[$i] = substr($a[$i],0,strpos($a[$i],$end));
      }
    }
    if(is_array($b)){
      $b=array_values($b);
    }
    if($multiple===false){
      return $b[0];
    }
    else{
      return $b;
    }
  }
  
  ///////////////////////
  $in = $GLOBALS['_POST'];
  ///////////////////////

  ///////////////////////
  /////Project scope/////
  function parseURL($url)
  {
    $url = strtolower($url);
  	$s = split('/', $url);
  	$url = $s[0]."//".$s[2];
  	
  	return $url;
  }
  
  $fromURL = parseURL($_SERVER['HTTP_REFERER']);

  ///////////////////////
  /////Suite scope/////
  $suitename=between('<b>','</b>',strtolower($in['suite']),false);
  
  /*
  [numTestPasses] => 9 
  [numTestFailures] => 3 
  [numCommandPasses] => 292 
  [numCommandFailures] => 4 
  [numCommandErrors] => 1
  
  */
  $numTestPasses=$in['numTestPasses'];
  $numTestFailures=$in['numTestFailures'];
  $numCommandPasses=$in['numCommandPasses'];
  $numCommandFailures=$in['numCommandFailures'];
  $numCommandErrors=$in['numCommandErrors'];
  
  
  $status=$in['result'];
  $timeTaken=$in['totalTime'];
  $selenium_version=$in['selenium_version'];
  $selenium_revision=$in['selenium_revision'];
  $environment = $fromURL;
  
  $client = new phpSniff();
  //$browser = $client->property('long_name')." ".$client->property('version');
  //$platform = $client->property('platform')." ".$client->property('os');
  
  function explode_assoc($glue1, $glue2, $array)
  {
    $array2=explode($glue2, $array);
    foreach($array2 as  $val)
    {
              $pos=strpos($val,$glue1);
              $key=substr($val,0,$pos);
              $array3[$key] =substr($val,$pos+1,strlen($val));
    }
    return $array3;
  }
  
  $from = $_SERVER['HTTP_REFERER'];
  $fromparsed = parse_url($from);
  $params = explode_assoc('=','&',$fromparsed['query']);
  $p_id=1;
  $p_id=$params['p_id'];
  $platform=$params['o_id'];
  $browser=$params['b_id'];
  
  $s_id=$dbh->insert('TRM_suite',
    "
    NULL,  
    '$suitename',
    '$environment',
    '$status',
    '".date('Y-m-d H:i:s')."',
    '$timeTaken',
    '$browser',
    '$platform',
    '$selenium_version',
    '$selenium_revision',
    '',
    '',
    '',
    '',
    '',
    '$p_id'"
    ,
    "
    ID,
    suitename,
    environment,
    status,
    timeDate,
    timeTaken,
    browser,
    platform,
    selenium_version,
    selenium_revision,
    numTestPassed,
    numTestFailed,
    numCommandsPassed,
    numCommandsFailed,
    numCommandsErrors,
    p_id
    "
    
    );

  ///////////////////////
  ///////Test scope//////
  for($i=1;strlen($in["testTable_$i"])>0;$i++){ 
    $curTable=strtolower($in["testTable_$i"]);
    
    $curTable = str_replace('\"','',$curTable);
    
    $kill=between('<td','>',$curTable,true);
    for($k=0;$k<count($kill);$k++){
      $kill[$k]='<td'.$kill[$k].'>';
    }
    $curTable=str_replace($kill,'<td>',$curTable);
    
    $betw_thead=between('<thead>','</thead>',$curTable,false);
    
    $betw_thead=str_replace(array("\r", "\n"), "", $betw_thead);
    
    if(strpos($betw_thead,'failed')!==false){
      $Tstatus='failed';
      $numTestFailed++;}
    elseif(strpos($betw_thead,'passed')!==false){
      $Tstatus='passed';
      $numTestPassed++;}
    else{
      $Tstatus='NA';}
      
    $Tname=between('<td>','</td></tr>',$betw_thead,false);
    
    $betw_tbody=implode(between('<tbody>','</tbody>',$curTable,true));
    $Thelp=between('<!--','-->',$betw_tbody,false);

    $betw_tr=between('<tr','</tr>',$betw_tbody,true);
    
    $t_id=$dbh->insert('TRM_test',
                        "
                        NULL,
                        '$Tstatus',
                        '$Tname',  
                        '$s_id',
                        '$Thelp'
                        ",
                        "
                        ID,
                        status,
                        name,
                        s_id,
                        Thelp
                        ");
    
    ///////////////////////
    /////Command scope/////
    for($u=0;$u<count($betw_tr);$u++){
    
      $comm_arr = between('<td>','</td>',$betw_tr[$u],true);
      if(count($comm_arr)>1){
      
      $firstline=substr($betw_tr[$u],0,strpos($betw_tr[$u],'>'));
      
        if(strpos($firstline,'status_failed')!==false){
          $Cstatus='failed';
          $numCommandsFailed++;}
        elseif(strpos($firstline,'status_passed')!==false){
          $Cstatus='passed';
          $numCommandsPassed++;}
        elseif(strpos($firstline,'status_done')!==false){
          $Cstatus='done';
          //$numCommandsPassed++;
          }
        else{
          $Cstatus='notdone';
          $numCommandsErrors++;}
        
        $action = $comm_arr[0];
        $var1 = $comm_arr[1]; 
        $var2 = $comm_arr[2];
        $var2 = str_replace('&nbsp;',' ',$var2);
        
        $dbh->insert('TRM_commands',
                      "
                      NULL,
                      '$Cstatus',
                      '$action',
                      '$var1',
                      '$var2',  
                      '$t_id'
                      ",
                      "
                      ID,
                      status,
                      action,
                      var1,
                      var2,
                      t_id
                      ");
                      
      }
      
    }
   
  }
  
  $dbh->update('TRM_suite',"
  
  numTestPassed='$numTestPassed',
  numTestFailed='$numTestFailed',
  numCommandsPassed='$numCommandsPassed',
  numCommandsFailed='$numCommandsFailed',
  numCommandsErrors='$numCommandsErrors'",
  "ID = '$s_id'" 
  );
  
  $extravars=explode(',',$params['extravars']);
  if(count($extravars)==3){
    echo "Test done. <a href='login.php?name=$extravars[0]&pass=$extravars[1]&language=$extravars[2]&directgo=showReport.php?id=$s_id' target='_parent'>Click here to see results</a>";
  }
  else{
    echo "Test done";
  }
  
  echo "<br>
  <b> numTestPassed </b> Received: $numTestPasses Inserted: $numTestPassed <br />
  <b> numTestFailed </b> Received: $numTestFailures Inserted: $numTestFailed <br />
  <b> numCommandsPassed </b> Received: $numCommandPasses Inserted: $numCommandsPassed <br />
  <b> numCommandsFailed </b> Received: $numCommandFailures Inserted: $numCommandsFailed <br />
  <b> numCommandsErrors </b> Received: $numCommandErrors Inserted: $numCommandsErrors <br />
  ";
  
  
?>
