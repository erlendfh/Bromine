<?php include('protected.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <?php include('header.php'); ?>
    <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
    <?php include ('menu.php') ?>
    <?php include('TRMSubMenu.php') ?>
    
    <?php
    
    if($_POST['notfirst']!='1'){
      $tShowPassed=1;
      $tShowFailed=1;
      $cShowFailed=1;
      $tShowHelp=1;
    }
    
    if(isset($_GET['id'])){$_SESSION["sid"]=$_GET['id'];}
    $id = $_SESSION["sid"];

    if(isset($_POST['tShowPassed'])){$tShowPassed=$_POST['tShowPassed'];}

    if(isset($_POST['tShowFailed'])){$tShowFailed=$_POST['tShowFailed'];}

    if(isset($_POST['tShowHelp'])){$tShowHelp=$_POST['tShowHelp'];}

    if(isset($_POST['cShowPassed'])){$cShowPassed=$_POST['cShowPassed'];}

    if(isset($_POST['cShowFailed'])){$cShowFailed=$_POST['cShowFailed'];}

    if(isset($_POST['cShowNotdone'])){$cShowNotdone=$_POST['cShowNotdone'];}

    if(isset($_POST['cShowDone'])){$cShowDone=$_POST['cShowDone'];}
    
    ?>
<?php

$db = new DBHandler();

if(isset($_GET['highlight'])){
  $_SESSION['highlight']=$_GET['highlight'];
}
$highlight=$_SESSION['highlight'];

$report = new reportHandler($id);
$analysis = $report->get('analysis');
$tl = new testList($id,$tShowPassed,$tShowFailed);
echo "<table>";
echo "<tr valign='top'>";
echo "<td>";
echo $report->getSummary();
echo "</td>";
echo "<td>";
?>

<?php echo "<form method='post' action='?id=$id'>"; ?>
  <fieldset style='border: none;'>
    <input type='hidden' name='notfirst' value='1' />
    <input type='checkbox' name='tShowPassed' value='1' <?php if($tShowPassed){echo "checked='checked'";}?>/>
    <?php echo $lh->getText('Test succeded');?><br />
    <input type='checkbox' name='tShowFailed' value='1' <?php if($tShowFailed){echo "checked='checked'";}?>/>
    <?php echo $lh->getText('Test failed');?><br />
    <input type='checkbox' name='tShowHelp' value='1' <?php if($tShowHelp){echo "checked='checked'";}?>/>
    <?php echo $lh->getText('Help text');?><br />
    <input type='checkbox' name='cShowPassed' value='1' <?php if($cShowPassed){echo "checked='checked'";}?>/>
    <?php echo $lh->getText('Commands succeded');?><br />
    <input type='checkbox' name='cShowFailed' value='1' <?php if($cShowFailed){echo "checked='checked'";}?>/>
    <?php echo $lh->getText('Commands failed');?><br />
    <input type='checkbox' name='cShowDone' value='1' <?php if($cShowDone){echo "checked='checked'";}?>/>
    <?php echo $lh->getText('Commands done');?><br />
    <input type='checkbox' name='cShowNotdone' value='1' <?php if($cShowNotdone){echo "checked='checked'";}?>/>
    <?php echo $lh->getText('Commands not done');?><br />
    <input type="submit" value="<?php echo $lh->getText('Show');?>" />
  </fieldset>
</form>
<?php
echo "</td>";
echo "</tr>";
echo "</table>";

$num = $tl->max;


echo"<table class='main'>";
for ($i=0;$i<$num;$i++){ 
  
  if(strlen($tl->manstatus[$i])>0){
    echo "<tr class='status_".$tl->manstatus[$i]."'";
  }
  else{
    echo "<tr class='status_".$tl->status[$i]."'";
  }
  
  if($tl->id[$i]==$highlight){
    echo " id='highlight'";
  }
  echo ">";
  $theID = $tl->id[$i];
  $link = "<a href='' onclick=".'"'."window.open('editTest.php?t_id=$theID','mitvindue','height=450,width=615,resizable=yes,scrolling=yes');return false;".'"'."><img src='img/showComments.png' title='".$lh->getText('Properties')."' alt='".$lh->getText('Properties')."' /></a>";
  echo "<td>";
  if($analysis==1){echo "$link -";}
  echo "<b>".$tl->name[$i]."</b>";
  
  if(strlen($tl->manstatus[$i])>0){echo " (Manually passed)";}
  
  echo "</td>";
  if($tShowHelp){
    echo "<td><b>".$tl->Thelp[$i]."</b></td>";
  }
  echo "</tr>";
  
  
  $cl = new commandList($tl->id[$i],$cShowPassed,$cShowFailed,$cShowNotdone,$cShowDone);
  $num2 = $cl->max;
  
  for ($a=0;$a<$num2;$a++){
  
    if ($cl->action[$a] != 'captureScreenshot')
      {
        echo "<tr class='status_".$cl->status[$a]."'>";
          echo "<td>--".$cl->action[$a]."</td><td>".$cl->var1[$a]."</td><td>".str_replace('&nbsp;',' ',$cl->var2[$a])."</td>";
        echo "</tr>";
      }
    else
      {
      $output = $cl->var1[$a];
      $output = str_replace('\\', "/", $output);
      $output = split("/",$output);
      
      //print_r ($output);
      $path = "RC/".$output[5]."/".$output[7]."/ss/".$output[9];
        echo "<tr class='status_".$cl->status[$a]."'>";
          echo "<td>--".$cl->action[$a]."</td><td><a target='_blank' href='$path'>".$dbh->getText('View Screenshot')."</a></td><td>".str_replace('&nbsp;',' ',$cl->var2[$a])."</td>";
        echo "</tr>";
      }
  }
  //$id = $report->getFromTL('ID',$i);
  //$status = $report->getFromTL('status',$i);
  //$name = $report->getFromTL('name',$i);
  //echo $id;

}
echo "</table>";
?>

</body>
</html>



