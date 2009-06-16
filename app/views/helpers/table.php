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

        $this->output .= "<table class='combinations' cellspacing='0' cellspacing='0'>";
        $this->output .= "<tr>";
        $this->output .= "<td></td>";
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
                
                $checked = false;
                $status = 'none';
                foreach($combinations as $combination){
                    if($os['Operatingsystem']['id'] == $combination['Operatingsystem']['id'] && $browser['Browser']['id'] == $combination['Browser']['id']){
                        $checked = "CHECKED='CHECKED'";   
                        if(!empty($combination['Result'])){
                            $status = $combination['Result']['Test']['status'];
                            $link = array('controller' => 'Tests', 'action'=>'view', $combination['Result']['Test']['id']);
                        }else{
                            $status = 'notdone';
                        }
                    }
                    
                }
                $this->output .= "<td class='$status'>";
                
                if($edit){
                    $values = $browser['Browser']['id'].'/'.$os['Operatingsystem']['id'].'/'.$id;
                    $this->output .=  "<input type='checkbox' $checked onclick='new Ajax.Updater(".'"log",'.'"'."requirements/updateCombination/$values".'"'.")' />";
                }else{
                    if($checked){
                        if($status == 'failed' || $status == 'passed'){
                            $this->output .= $this->Ajax->link('X',$link,array('update'=>'Main'));
                        }
                        else{
                            $this->output .= "X";
                        } 
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
