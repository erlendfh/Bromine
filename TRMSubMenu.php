<?php
	
	if (mysql_result($dbh->select('TRM_defect_management',"WHERE `key` = 'useoutside'",'*'),0,"value") == 0){
		$defectpage = 'showDefects.php';
	} else {
		$defectpage = mysql_result($dbh->select('TRM_defect_management',"WHERE `key` = 'viewurl'",'*'),0,"value");
	}
	
    $pages = array( 'main.php',
                    'analysis.php',
                    'showReqs.php',
                    $defectpage
                    );
    $linktext = array(
                    'Raw data',
                    'Analysis',
                    'Show requirements',
                    'Show defects'
                    );
                    
    $file= end(explode('/',$_SERVER['SCRIPT_FILENAME']));
    
    $breakCount = 4;
?>
<table class='subMenu'>
<tr>

<?php

foreach ($pages as $key => $page){
    $count ++;
    if ($file == $page){$style = 'black';}else{$style='white';}
    echo "<td>";
        echo "<div style='background: #66CC00; font-family: verdana; font-weight: bold; height: 20px; cursor: pointer;'>";
            echo "<a href='$page' style='color: $style;' name='menulink'>";
                echo $lh->getText($linktext[$key]);
            echo "</a>";
        echo "</div>";
    echo "</td>";
    if ($count == $breakCount){echo "</tr><tr>"; $count = 0;}
}
?>
</tr>
</table>
