<?php
class MenuComponent extends Component{

    function __construct(){
        App::import('Model', 'Menu');
        $this->Menu = new Menu();
        
    }

    function createMenu($parent_id=null){
           $this->Menu->Behaviors->attach('Containable');

        $menus = $this->Menu->find('threaded');
        foreach($menus as $key => $menu){
            if($menu['Menu']['id']==$parent_id){
                return $menu['children'];
            }
        }
    }
}
?>
