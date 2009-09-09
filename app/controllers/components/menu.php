<?php
class MenuComponent{
    
    function __construct(){
        App::import('Model', 'Menu');
        $this->Menu = new Menu();
        App::import('Model', 'Plugin');
        $this->Plugin = new Plugin();
    }

    function createMenu($parent_id=null){
        $menus = $this->Menu->find('threaded',array('order'=>'odr'));
        foreach($menus as $key => $menu){
            if($menu['Menu']['id']==$parent_id){
                $Menu = $menu['children'];
                $plugins = $this->Plugin->findByActivated(1);
                if(!empty($plugins)){
                    foreach($plugins as $plugin){
                        $name = $plugin['name'];
                        $children[] = array(
                            'Menu' => array(
                                'title' => $name,
                                'controller' => $name,
                                'action' => $name,
                                'target' => '_blank'
                                 
                            )
                        ); 
                    }
                    $Menu[] = array(
                        'Menu' => array(
                            'title' => 'Plugins',
                            'controller' => '',
                            'action' => ''
                        ),
                        'children' => $children
                        
                    );
                    
                }
                return $Menu;
            }
        }
    }
    
}
?>
