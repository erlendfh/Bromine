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
  
  function show($name, $data)
  {
    
    list($modelName, $fieldName) = explode('/', $name);
    $output = $this->list_element($data, $modelName, $fieldName, 0);
    
    return $this->output($output);
    
  }
  
  function show2($name, $data)
  {
    
    list($modelName, $fieldName) = explode('/', $name);
    $output = $this->list_element2($data, $modelName, $fieldName);
    
    return $this->output($output);
    
  }
  
  function list_element($data, $modelName, $fieldName, $level){
    
    if($level == 0){
        $output = "<ul id='tree' class='req'>";
    }else{
        $output = "<ul class='req'>";
    }
    foreach ($data as $key=>$val){

      $output .= "<li id='node_".$val[$modelName]['id']."'>";

      if(isset($val['children'][0])){
        $output .= "<span class='handle'></span>";
        $output .= $this->Ajax->link( 
            $val[$modelName][$fieldName], 
            array( 'controller' => 'requirements', 'action' => 'view', $val[$modelName]['id']), 
            array( 'update' => 'lala' )
        );
        $output .= $this->list_element($val['children'], $modelName, $fieldName, $level+1);
        if(!empty($val['Testcase'])){
            $output .= "<ul class='tc'>";
            foreach($val['Testcase'] as $testcase){
                $output .= "<li>";
                $output .= $this->Ajax->link( 
                    $testcase['name'], 
                    array( 'controller' => 'testcases', 'action' => 'view', $testcase['id']), 
                    array( 'update' => 'lala' )
                );
                $output .= "</li>";
            }
            $output .= "</ul>";
        }
        $output .= "</li>";
      }
      else{
        $output .= $this->Ajax->link( 
            $val[$modelName][$fieldName], 
            array( 'controller' => 'requirements', 'action' => 'view', $val[$modelName]['id']), 
            array( 'update' => 'lala' )
        );
        if(!empty($val['Testcase'])){   
            $output .= "<ul class='tc'>";
            foreach($val['Testcase'] as $testcase){
                $output .= "<li>";
                $output .= $this->Ajax->link( 
                    $testcase['name'], 
                    array( 'controller' => 'testcases', 'action' => 'view', $testcase['id']), 
                    array( 'update' => 'lala' )
                );
                $output .= "</li>";
            }
            $output .= "</ul>";
        }
        $output .= "</li>";
      }

    }
    $output .=  "</ul>";
    
    return $output;
  }
  
    function list_element2($data, $modelName, $fieldName){
        if(empty($output)){$output="";}
        foreach ($data as $key=>$val){
            $output .= "<li id='node_req".$val[$modelName]['id']."' class='req'>";
            $output .= $this->Ajax->link(
                $val[$modelName][$fieldName], 
                array( 'controller' => 'requirements', 'action' => 'view', $val[$modelName]['id']), 
                array( 'update' => 'lala' )
            );
            
            if(!empty($val['children'])  || !empty($val['Testcase'])){
                $output .= "<span class='handle'></span>";
            }else{
                $output .= "<span></span>";
            }
            
            if(!empty($val['children'])){
                $output .= "<ul>";
                $output .= $this->list_element2($val['children'], $modelName, $fieldName);
                $output .= "</ul>";
            }
            
            if(!empty($val['Testcase'])){
                $output .= "<ul>";
                
                foreach($val['Testcase'] as $testcase){
                    $output .= "<li id='node_tc".$testcase['id']."' class='tc'>";
                    
                    $output .= $this->Ajax->link( 
                        $testcase['name'], 
                        array( 'controller' => 'testcases', 'action' => 'view', $testcase['id']), 
                        array( 'update' => 'lala' )
                    );
                    $output .= "<span></span>";
                    $output .= "</li>";
                }
                $output .= "</ul>";
            }
            $output .= "</li>";
            
        }
        return $output;
    }
}
?>
