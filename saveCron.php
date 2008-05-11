<?php include ('protected.php'); ?>
<?php
  
  function doat($cmd, $time){
  $output = shell_exec("sudo -u www sh -c \"echo '".$cmd."' | at ".$time."\"");
  }
  
  function get_crontab(){
   return shell_exec('crontab -l');
  }
  
  function clear_crontab(){
    return shell_exec("crontab -r");
  }
  
  
  function updatecron($cron){
    $filename = "/tmp/www.crontab";
    shell_exec("echo '".$cron."' > ".$filename);
    shell_exec("crontab ".$filename);
    shell_exec("rm ".$filename);
  }

  //print_r($GLOBALS['_POST']);
  
  $disabled=$_POST['disabled'];
  $minutes=$_POST['minutes'];
  $hours=$_POST['hours'];
  $days=$_POST['days'];
  $months=$_POST['months'];
  $weekdays=$_POST['weekdays'];
  $tasks=$_POST['tasks'];
  

  //$cron=$_POST['minutes'];
  $new_cmd=$_POST['new_cmd'];
  $new_time=$_POST['new_time'];
  //&& strlen($tasks[$i])>0
  for($i=0;$i<count($tasks);$i++){
    if(strlen($tasks[$i])>0){
    $tasks[$i]=str_replace(array("\'",'\"'),'"',$tasks[$i]);
        if($i==count($tasks)-1){
          $cron.="$disabled[$i]$minutes[$i] $hours[$i] $days[$i] $months[$i] $weekdays[$i] $tasks[$i]";
        }
      else{
        $cron.="$disabled[$i]$minutes[$i] $hours[$i] $days[$i] $months[$i] $weekdays[$i] $tasks[$i]\n";
      }
    }
    
  }
  updatecron($cron);
  
  header("Location: editCron.php");
?>
