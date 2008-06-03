<?php include ('protected.php'); 
?>
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
error_reporting(0);
include_once('reportHandler.class.php');
include_once('graph.class.php');
include_once('DBHandler.class.php');
include_once('distinctDropDown.php');

$check=$_POST['check'];
if($check!=''){
  foreach($check as $v){
    $dbh->update('TRM_suite',"analysis=1","ID=$v"); 
  }
}

$move = 15;
$projectID=$_SESSION['p_id'];
$projectName=$_SESSION['p_name'];
$limit = $_GET['limit'];
$sort = $_GET['sort'];
$_SESSION['highlight']='';
if (!isset($limit)){
  $limit = 0;
}
$limitMinus = $limit - $move;
if ($limitMinus < 0){
  $limitMinus = 0;
}
$limitPlus = $limit + $move;

if(isset($_POST['suitename'])){
	$_SESSION["suitename"]=$_POST['suitename'];
}
if(isset($_POST['environment'])){
	$_SESSION["environment"]=$_POST['environment'];
}
if(isset($_POST['platform'])){
	$_SESSION["platform"]=$_POST['platform'];
}
if(isset($_POST['browser'])){
	$_SESSION["browser"]=$_POST['browser'];
}
if(isset($_POST['timeDate1'])){
	$_SESSION["timeDate1"]=$_POST['timeDate1'];
}
if(isset($_POST['timeDate2'])){
	$_SESSION["timeDate2"]=$_POST['timeDate2'];
}

echo "<form action='' method='post'>";
echo "<fieldset style='border: none;'>";
echo "<p>".$lh->getText('Suite name').":</p>"; distinctDropDown('suitename', $projectID);
echo "<p>".$lh->getText('environment').":</p>"; distinctDropDown('environment', $projectID);
echo "<p>".$lh->getText('Platform').":</p>"; distinctDropDown('platform', $projectID);
echo "<p>".$lh->getText('Browser').":</p>"; distinctDropDown('browser', $projectID);

echo " ".$lh->getText('From').": "; echo "<input type='text' name='timeDate1' value='";
if(isset($_SESSION["timeDate1"])){echo "".$_SESSION["timeDate1"]."";} 
else{echo $lh->getText('yyyy-mm-dd');} 
echo "' />";

echo " ".$lh->getText('To').": "; echo "<input type='text' name='timeDate2' value='";
if(isset($_SESSION["timeDate2"])){echo "".$_SESSION["timeDate2"]."";}
else{echo $lh->getText('yyyy-mm-dd');} 
echo "' />";

echo " <input type='submit' value='".$lh->getText('Show')."' />";
echo " <input type='reset' value='".$lh->getText('reset')."' />";
echo "</fieldset>";
echo "</form>";

echo "<p>".$lh->getText('Project').": <b>$projectName</b><br /><br /></p>";

	if(isset($_GET['sort'])){
		$_SESSION["sortkey"]=$_GET['sort'];
	}
	else{
		$_SESSION["sortkey"]="ID";
	}
	if(!isset($_SESSION["direction"])){
		$_SESSION["direction"]="DESC";
	}

	if($_SESSION["sortkey"]==$_GET['sort']){
		if($_SESSION["direction"]=="ASC"){
			$_SESSION["direction"]="DESC";
		}
		else{
			$_SESSION["direction"]="ASC";
		}
	}
	$sortkey=$_SESSION['sortkey'];
	$sortdirection=$_SESSION['direction'];

	//$select = "WHERE ID != 'slamløsning'";
	$select = "WHERE p_id='$projectID' AND analysis=0";
	$txt = $lh->getText('All');
  $tdtxt = "yyyy-mm-dd";
	if(isset($_SESSION['browser']) && $_SESSION['browser'] != "$txt"){
		$select .= " AND browser = '".$_SESSION['browser']."'";

	}
	if(isset($_SESSION['platform']) && $_SESSION['platform'] != "$txt"){
		$select .= " AND platform = '".$_SESSION['platform']."'";
	}
	if(isset($_SESSION['suitename']) && $_SESSION['suitename'] != "$txt"){
		$select .= " AND suitename = '".$_SESSION['suitename']."'";
	}
	if(isset($_SESSION['environment']) && $_SESSION['environment'] != "$txt"){
		$select .= " AND environment = '".$_SESSION['environment']."'";
	}
	if(isset($_SESSION['timeDate1']) && $_SESSION['timeDate1'] != "$tdtxt"){
		$select .= " AND timeDate >= '".$_SESSION['timeDate1']."'";
	}
	if(isset($_SESSION['timeDate2']) && $_SESSION['timeDate2'] != "$tdtxt"){
		$select .= " AND timeDate <= '".$_SESSION['timeDate2']."'";
	}
	$iddbh = new DBhandler();
	//echo ">>$select<<<br />";
	$result=$iddbh->select('TRM_suite',"$select ORDER by $sortkey $sortdirection LIMIT $limit , $move",'ID');
	//echo $iddbh->query;
	$numreports=mysql_numrows($result);

	if ($numreports > 0){
	echo "<form action='?sendToAnalysis=1' method='post'>
	<table class='collapse'>
		<tr>";
		  
      echo"
      <td></td>
			<td>&nbsp;</td>
			<td><a href='?sort=timeDate'><b>".$lh->getText('Date')."</b></a></td>
			<td><a href='?sort=suitename'><b>".$lh->getText('Suite name')."</b></a></td>
			<td><a href='?sort=environment'><b>".$lh->getText('environment')."</b></a></td>
			<td><a href='?sort=selenium_version'><b>".$lh->getText('Sel. ver.')."</b></a></td>
			<td><a href='?sort=selenium_revision'><b>".$lh->getText('Sel. rev.')."</b></a></td>
			<td><a href='?sort=Browser'><b>".$lh->getText('Browser')."</b></a></td>
			<td><a href='?sort=Platform'><b>".$lh->getText('Platform')."</b></a></td>
			<td><a href='?sort=numTestPassed'><b>".$lh->getText('Test suc.')."</b></a></td>
			<td><a href='?sort=numTestFailed'><b>".$lh->getText('Test fail.')."</b></a></td>
			<td><b>".$lh->getText('Pass man.')."</b></td>";
      echo"
      <td><a href='?sort=numTestPassed'><b>".$lh->getText('T graph')."</b></a></td>";
            
      echo "</tr>";

		for($a=0;$a<$numreports;$a++){
			$s_id = mysql_result($result,$a,"ID");
			$report[$a] = new reportHandler($s_id);
	    if ($bgcolor == 'rgb(211,211,211)'){
        $bgcolor = 'transparent';
      }else{
        $bgcolor = 'rgb(211,211,211)';
      }
			echo "<tr style='background-color: $bgcolor;'>";
			echo "<td>";
      

      $confirm='"'.$lh->getText('confirmDelete').'"';
	    echo "<a href='delete.php?type=suite&amp;id=$s_id&amp;back=main.php?limit=$limit' onclick='return confirm($confirm)'><img src='img/trashcan.gif' alt='".$lh->getText('Delete')."' /></a>"; 
      
      
      echo "</td>";

			echo "<td><input type='checkbox' name='check[]' value='".$report[$a]->get('s_id')."' /></td>";
			$id = $report[$a]->get('s_id');
			echo "<td><a href='showReport.php?id=$id'>".$report[$a]->get('timeDate')."</a></td>";

			echo "<td>".$report[$a]->get('suitename')."</td>
          <td>".$report[$a]->get('environment')."</td>
          <td>".$report[$a]->get('selenium_version')."</td>
          <td>".$report[$a]->get('selenium_revision')."</td>
          <td>".$report[$a]->get('browser')."</td>
          <td>".$report[$a]->get('platform')."</td>
          <td>".$report[$a]->get('numTestPassed')."</td>
          <td>".$report[$a]->get('numTestFailed')."</td>";
          echo "<td>".$report[$a]->get('numPassedMan')."</td>";

			$g = new graph($report[$a]->get('numTestPassed'), $report[$a]->get('numTestFailed') - $report[$a]->get('numPassedMan'),0,$report[$a]->get('numPassedMan'));
			echo $g->getGraph();
          
			echo "</tr>";

		}

	}
	else{
		echo "<h1>".$lh->getText('No reports')."</h1>";
	}
	echo "</table>";
	if ($sort != ''){
  
  echo "<table>
          <tr>
            <td><a href='main.php?sort=$sort&amp;limit=$limitMinus'>".$lh->getText('Previous 15')."</a></td>
            <td align='right'><a href='main.php?sort=$sort&amp;limit=$limitPlus'>".$lh->getText('Next 15')."</a></td>
          </tr>
        </table>";
  }
  if ($sort == ''){
  
  echo "<table>
          <tr>
            <td><a href='main.php?limit=$limitMinus'>".$lh->getText('Previous 15')."</a></td>
            <td align='right'><a href='main.php?limit=$limitPlus'>".$lh->getText('Next 15')."</a></td>
          </tr>
        </table>";
  }
  
  
  if(!$lite){
    echo "<div><input type='submit' value='".$lh->getText('Send to analysis')."' /></div>";
	}

?>
</form>
</body>
</html>
