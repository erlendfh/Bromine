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
  var $i = 0;
  
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
            $fullname = $val[$modelName][$fieldName];
            $name = (strlen($fullname)>20 ? substr($fullname,0,20).'...' : $fullname);
            
            $output .= $this->Ajax->link(
                $name, 
                array( 'controller' => 'requirements', 'action' => 'view', $val[$modelName]['id']), 
                array( 'update' => 'Main', 'class'=>'reqhandle', 'title'=>$fullname)
            );
            
            
            $output .= "<ul>";
            
            
            if(!empty($val['Testcase'])){
                
                foreach($val['Testcase'] as $testcase){
                    $output .= "<div id='req_".$val[$modelName]['id']."_tc_".$testcase['id']."'style='clear: both;' class='tc'>";
                    $output .= "<span class='spacer'></span>";
                    $fullname = $testcase['name'];
                    $name = (strlen($fullname)>20 ? substr($fullname,0,20).'...' : $fullname);
                    
                    $output .= $this->Ajax->link(
                        $name, 
                        array( 'controller' => 'testcases', 'action' => 'view', $testcase['id']), 
                        array( 'update' => 'Main', 'title'=>$fullname)
                    );

                    //$output .= "&nbsp;<a  class='del hide' onclick='removetc(this.up(".'"div"'."), this.up(".'"li"'."));'><img src='/img/tango/16x16/places/user-trash.png'></img></a>";
                    $output .= "</div>";
                }
  
            }
            if(!empty($val['children'])){
                $output .= $this->list_element2($val['children'], $modelName, $fieldName);
            }
            $output .= "</ul>";
            $output .= "</li>";
            
        }
        return $output;
    }
    
  function testlabshow($name, $data)
  {
    
    list($modelName, $fieldName) = explode('/', $name);
    $output = $this->testlablist_element($data, $modelName, $fieldName);
    
    return $this->output($output);
    
  }
  
  
    function testlablist_element($data, $modelName, $fieldName){
        if(empty($output)){$output="";}
        foreach ($data as $key=>$val){

            $output .= "<li id='req_".$val[$modelName]['id']."' style='clear: both;' class='req'>";
            
            if(!empty($val['children'])  || !empty($val['Testcase'])){ //output a +- handle
                $output .= "<span class='spacer handle'></span>";
            }else{ //output a empty span to align things correctly
                $output .= "<span class='spacer'></span>";
            }
            $fullname = $val[$modelName][$fieldName];
            $name = (strlen($fullname)>20 ? substr($fullname,0,20).'...' : $fullname);
            
            $output .= $this->Ajax->link(
                $name,  
                array( 'controller' => 'requirements', 'action' => 'testlabview', $val[$modelName]['id']), 
                array( 'update' => 'Main', 'class'=>'reqhandle', 'title'=>$fullname)
            );
            $output .= "<img src='img/".$val[$modelName]['status'].".png' style='height: 16px; margin-top: -18px;  margin-right: -26px; float: right;'/>";
            
            $output .= "<ul>";
            
            
            if(!empty($val['Testcase'])){
                
                foreach($val['Testcase'] as $testcase){
                    //pr($testcase);
                    $output .= "<div id='tc_".$testcase['id']."'style='clear: both;' class='tc'>";
                    $output .= "<span class='spacer'></span>";
                    $fullname = $testcase['name'];
                    $name = (strlen($fullname)>20 ? substr($fullname,0,20).'...' : $fullname);
                    
                    $output .= $this->Ajax->link(
                        $name,  
                        array( 'controller' => 'testcases', 'action' => 'testlabview', $testcase['id'], $val[$modelName]['id']), 
                        array( 'update' => 'Main', 'title'=>$fullname)
                    );

                    $output .= "&nbsp;<a  class='del hide' onclick='removetc(this.up(".'"div"'."), this.up(".'"li"'."));'><img src='/img/tango/16x16/places/user-trash.png'></img></a>";
                    $output .= "<img src='img/".$testcase['status'].".png' style='height: 16px;  margin-top: -18px; margin-right: -26px; float: right;'/>";
                    $output .= "</div>";
                }
  
            }
            if(!empty($val['children'])){
                $output .= $this->testlablist_element($val['children'], $modelName, $fieldName);
            }
            $output .= "</ul>";
            $output .= "</li>";
            
        }
        return $output;
    }
    
    function menustart($list){
    $output = "";
        foreach($list as $menu){
            $output .= "<ul><li>";
            if(!empty($menu['Menu']['controller'])){
                $output .= $this->Html->link($menu['Menu']['title'],array('controller'=>$menu['Menu']['controller'], 'action'=>$menu['Menu']['action']));
            }else{
                $output .= '<a style="cursor: default;">'.$menu['Menu']['title'].'</a>';               
            }
            $output.="<ul>";
            if(!empty($menu['children'])){
                $output .= $this->menutree($menu['children']);
            }
            $output .= "</ul></li></ul>";
        }
        return $output;
    
    }
        
    function menutree($list){
        $output='';
        foreach ($list as $menu){   
            $output .= "<li>";
            $output .= $this->Html->link($menu['Menu']['title'],array('controller'=>$menu['Menu']['controller'], 'action'=>$menu['Menu']['action']));            
            
            if(!empty($menu['children'])){

                $output .= '<ul>'.$this->menutree($menu['children']).'</ul>';
            }
            $output .= "</li>";
            
            
        }
        return $output;
    }    
}
?>
