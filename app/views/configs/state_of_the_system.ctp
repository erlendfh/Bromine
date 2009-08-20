<h1>State of the System</h1>
<div class="index">
<table style='border: 1px solid; border-color: rgb(192,192,192);' cellpadding="0" cellspacing="0">
    <tr>
        <th>Condition</th>
        <th>Result</th>
        <th>Output</th>
    </tr>
<?php

$i=0;
foreach ($state as $key=>$value) {
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
    echo "<tr $class>";
    
    if ($key == 'Java'){
        echo "<td >$key</td>";
        if ($value == 0){
            echo "<td>".$html->image('passed.png',array('height'=>'16px', 'alt' => 'passed'))."</td>";
            echo "<td>".$output['Java']."</td>";
        }else{
            echo "<td>".$html->image('warning.png',array('height'=>'16px', 'alt' => 'warning'))."</td>";
            echo "<td> You are not able to run Java testscripts, add Java bin directory to your classpath variable </td>";
        }
    }
    
    if ($key == 'Php'){
        echo "<td>$key</td>";
        if ($value == 0){

            echo "<td>".$html->image('passed.png',array('height'=>'16px', 'alt' => 'passed'))."</td>";
            echo "<td>".$output['Php']."</td>";
        }else{

            echo "<td>".$html->image('warning.png',array('height'=>'16px', 'alt' => 'warning'))."</td>";
            echo "<td> You are not able to run PHP testscripts, add PHP bin directory to your classpath variable </td>";
        }
    }
    
    if ($key == 'Ruby'){
        echo "<td>$key</td>";
        if ($value == 0){

            echo "<td>".$html->image('passed.png',array('height'=>'16px', 'alt' => 'passed'))."</td>";
            echo "<td>".$output['Ruby']."</td>";
        }else{
            
            echo "<td>".$html->image('warning.png',array('height'=>'16px', 'alt' => 'warning'))."</td>";
            echo "<td> You are not able to run ruby testscripts, add ruby bin directory to your classpath variable </td>";
        }
    }
    
    if ($key == 'Magic Quotes'){
        echo "<td>$key</td>";
        if ($value == 0){
            
            echo "<td>".$html->image('passed.png',array('height'=>'16px', 'alt' => 'passed'))."</td>";
            echo "<td> Magic Quotes is Off.</td>";
        }else{
            
            echo "<td>".$html->image('failed.png',array('height'=>'16px', 'alt' => 'failed'))."</td>";
            echo "<td> Magic Quotes shall be set to: Off. Change your php.ini file </td>";
        }
    }
    
    if ($key == 'Max execution time'){
        echo "<td>$key</td>";
        if ($value >= 60000){
            
            echo "<td>".$html->image('passed.png',array('height'=>'16px', 'alt' => 'passed'))."</td>";
            echo "<td>Yours is set to:".ini_get('max_execution_time')."</td>";
        }else{
            
            echo "<td>".$html->image('failed.png',array('height'=>'16px', 'alt' => 'failed'))."</td>";
            echo "<td> Max execution time should be larger or equal then 60000 miliseconds! Yours is set to:".ini_get('max_execution_time')."</td>";
        }
    }
    
    if ($key == 'Permissions'){
        echo "<td>$key</td>";
        if ($value == true){
            
            echo "<td>".$html->image('passed.png',array('height'=>'16px', 'alt' => 'passed'))."</td>";
            echo "<td>Project dirs are writeable</td>";
        }else{
            
            echo "<td>".$html->image('failed.png',array('height'=>'16px', 'alt' => 'failed'))."</td>";
            echo "<td>Project dirs are NOT writeable: ".$state['Permissions output']."</td>";
        }
    }

    if ($key == 'Logs dir'){
        echo "<td>$key</td>";
        if ($value == true){
            
            echo "<td>".$html->image('passed.png',array('height'=>'16px', 'alt' => 'passed'))."</td>";
            echo "<td>Logs dir is writeable</td>";
        }else{
            
            echo "<td>".$html->image('failed.png',array('height'=>'16px', 'alt' => 'failed'))."</td>";
            echo "<td>Logs dir is NOT writeable</td>";
        }
    }

    if ($key == 'Img/temp dir'){
        echo "<td>$key</td>";
        if ($value == true){
            
            echo "<td>".$html->image('passed.png',array('height'=>'16px', 'alt' => 'passed'))."</td>";
            echo "<td>Img/temp dir is writeable</td>";
        }else{
            
            echo "<td>".$html->image('failed.png',array('height'=>'16px', 'alt' => 'failed'))."</td>";
            echo "<td>Img/temp dir is NOT writeable</td>";
        }
    }

    if ($key == 'Registrated Bromine'){
        echo "<td>$key</td>";
        if ($value == '1'){
            
            echo "<td>".$html->image('passed.png',array('height'=>'16px', 'alt' => 'passed'))."</td>";
            echo "<td>You have registrated your copy of Bromine</td>";
        }else{
            
            echo "<td>".$html->image('warning.png',array('height'=>'16px', 'alt' => 'warning'))."</td>";
            echo "<td>You have NOT registrated your copy of Bromine</td>";
        }
    }

    if ($key == 'Email developers on error'){
        echo "<td>$key</td>";
        if ($value == '1'){
            
            echo "<td>".$html->image('passed.png',array('height'=>'16px', 'alt' => 'passed'))."</td>";
            echo "<td>Your version of Bromine will send an email if any error occours</td>";
        }else{
            
            echo "<td>".$html->image('warning.png',array('height'=>'16px', 'alt' => 'warning'))."</td>";
            echo "<td>Your version of Bromine will NOT send an email if any error occours</td>";
        }
    }
        
    
    echo "</tr>";
	
}

?>
</table>
</div>