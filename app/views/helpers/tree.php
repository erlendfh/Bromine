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


class TreeHelper extends Helper
{
  var $tab = "";
  var $helpers = array('Html','Ajax','Javascript');
  var $level = 0;
  
  function show($name, $data)
  {
    

    list($modelName, $fieldName) = explode('/', $name);
    $output = $this->list_element($data, $modelName, $fieldName, 0);
    
    return $this->output($output);
    
  }
  
  function list_element($data, $modelName, $fieldName, $level)
  {
    
    $tabs = "\n" . str_repeat($this->tab, $level * 2);
    $li_tabs = $tabs . $this->tab;
    $li_tabs = "";
    if($this->level == 0){
        $output = $tabs. "<ul id='tree'>";
    }else{
        $output = $tabs. "<ul>";
    }
    foreach ($data as $key=>$val)
    {
      //$output .= $li_tabs . "<li>".$val[$modelName][$fieldName];
      $class = "";
      if(!isset($val['children'][0])){
        $class = " class = 'file'";
      }
      $output .= $li_tabs . "<li id='node_".$val[$modelName]['id']."' $class>";
                                            /*
                                            $this->Ajax->link( 
                                                $val[$modelName][$fieldName], 
                                                array( 'controller' => 'requirements', 'action' => 'view', $val[$modelName]['id']), 
                                                array( 'update' => 'lala' )
                                            );
                                            */ 
    $this->level++;
      if(isset($val['children'][0]))
      {
        $output .= "<span class='handle'></span>";
        //$output .= "<a>".$val[$modelName][$fieldName]."</a>";
        $output .= $this->Ajax->link( 
            $val[$modelName][$fieldName], 
            array( 'controller' => 'requirements', 'action' => 'view', $val[$modelName]['id']), 
            array( 'update' => 'lala' )
        );
        $output .= $this->list_element($val['children'], $modelName, $fieldName, $level+1);
        $output .= $li_tabs . "</li>";
      }
      else
      {
        //$output .= "<a>".$val[$modelName][$fieldName]."</a>";
        $output .= $this->Ajax->link( 
            $val[$modelName][$fieldName], 
            array( 'controller' => 'requirements', 'action' => 'view', $val[$modelName]['id']), 
            array( 'update' => 'lala' )
        );
        $output .= "</li>";
      }
    }
    $output .= $tabs . "</ul>";
    
    return $output;
  }
}
?>
