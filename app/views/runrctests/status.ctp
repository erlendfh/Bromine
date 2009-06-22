<?php
    //pr($Suite);
    if(isset($Suite)){
        foreach($Suite['Test'] as $test){
            echo "<div style='border: 1px solid black; margin-top: 10px;'>";
            echo "<strong>".$test['name']."</strong> in ".$test['Browser']['name'].' on '.$test['Operatingsystem']['name'];
            echo "<table>";
            foreach($test['Command'] as $command){
                echo "<tr class='".$command['status']."'>";
                echo "<td>".$command['action']."</td><td>".$command['var1']."</td><td>".$command['var2']."</td>";
                echo "</tr>";
            }
            echo "</table>";
            echo "</div>";
        }
    }
    
?>
