<?php 
/**
 * TableHelper class.
 *
 * Creates a table of browser/OS and highlights a passed array of combinations
 */

/**
 * 
 * @Author: Rasmus Berg Palm and Visti Kløft
*/


class TableHelper extends Helper{

    var $helpers = array('Html','Ajax','Javascript');
    var $output = "";
    
    function createTable($browsers, $operatingsystems, $combinations=array(), $edit=false, $id=null){
        //pr($combinations);
        //exit;
        //pr($browsers);
        $this->output .= "<table class='combination table' border='1'>";
        $this->output .= "<tr>";
        $this->output .= "<td>XXXX</td>";
        foreach($operatingsystems as $os){
            $this->output .= "<td>".$os['Operatingsystem']['name']."</td>";
        }
        $this->output .= "</tr>";
        foreach($browsers as $browser){
            $this->output .= "<tr>";
            $u=0;
            foreach($operatingsystems as $os){
                if($u==0){
                    $this->output .= "<td>".$browser['Browser']['name']."</td>";
                }
                $u++;
                $this->output .= "<td>";
                $checked = false;
                foreach($combinations as $combination){
                    if($os['Operatingsystem']['id'] == $combination['Operatingsystem']['id'] && $browser['Browser']['id'] == $combination['Browser']['id']){
                        $checked = "CHECKED='CHECKED'";   
                    }
                }
                if($edit){
                    $values = $browser['Browser']['id'].'/'.$os['Operatingsystem']['id'].'/'.$id;
                    $this->output .=  "<input type='checkbox' $checked onclick='new Ajax.Updater(".'"log",'.'"'."requirements/updateCombination/$values".'"'.")' />";
                }else{
                    if($checked){
                        $this->output .= "X"; 
                    }
                }
                
                $this->output .= "</td>";
            }
            $this->output .= "</tr>";
        }
        $this->output .= "</table>";
        return $this->output;
    }
    
}
?>
