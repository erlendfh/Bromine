<?php
//Get the menu from the database
class MenuComponent extends Component{
    function fetchData(){
        //Dynamically Loading the model of the menu, because it's not necessary to have it on every controller.
        App::import('Model', 'Menu');
        $this->Menu = new Menu();
        $mainmenu = $this->Menu->find('all', array( 'conditions' => array('p_id' => 0)));
        
        $absolute_url  = Router::url("", false);
        foreach ($mainmenu as $menu)
        {
            if ($menu['Menu']['link'] == $absolute_url)
            {
                $p_id = $menu['Menu']['id'];
            }
        }
        
        // Add submenu, if there is one in the DB
        if (isset($p_id))
        {
            $submenu = $this->Menu->find('all', array( 'conditions' => array('p_id' => $p_id)));
            $mainmenu = am($mainmenu,$submenu);
        }

        
        return $mainmenu;
    }
}
?>