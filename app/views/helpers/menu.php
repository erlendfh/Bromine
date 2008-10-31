<?php
class MenuHelper extends Helper {
   function display($data) {
      //This extracting only the name of the menu from the multidimentional array.
      $ret = '';
      $linebreak = false;
      foreach ($data['Menu'] as $menu)
      {
        //var_dump ($menu['Menu']['p_id']);
        if ($menu['Menu']['p_id'] != "0" && $linebreak == false)
        {   
            $ret .= "<br />"; 
            $linebreak = true;
        }

            $ret .= "<a href='".$menu['Menu']['link']."'>".$menu['Menu']['title']."</a> ";

      }
      $absolute_url  = Router::url("", false);
      
      //echo $absolute_url;
      /*
      $title = Set::extract($data['Menu'], '{n}.Menu.title');
      $link = Set::extract($data['Menu'], '{n}.Menu.link');
      $ret = '';
      for ($i = 0; $i<count($title);$i++ ) 
      {
        $ret .= "<a href='$link[$i]'>$title[$i]</a> ";	
      }
      */
      return $ret;
   }
}
?>