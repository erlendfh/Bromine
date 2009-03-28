<?php 
/**
 * TreeHelper class.
 *
 * Written for bakery to show an example of parsing
 * data from findAllThreaded().
 */

/*

Copyright (c) 2006 James Hall

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 
*/


class TreeHelper extends Helper{
  var $tab = "";
  var $helpers = array('Html','Ajax','Javascript');
  
  
  function show2($name, $data)
  {
    
    list($modelName, $fieldName) = explode('/', $name);
    $output = $this->list_element2($data, $modelName, $fieldName);
    
    return $this->output($output);
    
  }
  
  
    function list_element2($data, $modelName, $fieldName){
        if(empty($output)){$output="";}
        foreach ($data as $key=>$val){

            $output .= "<li id='req_".$val[$modelName]['id']."' style='clear: both;' class='req'>";
            
            if(!empty($val['children'])  || !empty($val['Testcase'])){ //output a +- handle
                $output .= "<span class='spacer handle'></span>";
            }else{ //output a empty span to align things correctly
                $output .= "<span class='spacer'></span>";
            }
            $output .= $this->Ajax->link(
                $val[$modelName][$fieldName], 
                array( 'controller' => 'requirements', 'action' => 'view', $val[$modelName]['id']), 
                array( 'update' => 'lala', 'class'=>'reqhandle')
            );
            
            
            $output .= "<ul>";
            if(!empty($val['children'])){
                $output .= $this->list_element2($val['children'], $modelName, $fieldName);
            }
            
            if(!empty($val['Testcase'])){
                
                foreach($val['Testcase'] as $testcase){
                    $output .= "<div id='tc_".$testcase['id']."'style='clear: both;' class='tc'>";
                    $output .= "<span class='spacer'></span>";
                    $output .= $this->Ajax->link(
                        $testcase['name'], 
                        array( 'controller' => 'testcases', 'action' => 'view', $testcase['id']), 
                        array( 'update' => 'lala')
                    );

                    $output .= "&nbsp;<a  class='del hide' onclick='removetc(this.up(".'"div"'."), this.up(".'"li"'."));'><img src='/img/tango/16x16/places/user-trash.png'></img></a>";
                    $output .= "</div>";
                }
  
            }
            $output .= "</ul>";
            $output .= "</li>";
            
        }
        return $output;
    }
}
?>
