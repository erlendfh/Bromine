<?php
class MenuComponent{

    function __construct(){
        App::import('Model', 'Menu');
        $this->Menu = new Menu();
    }

    function createMenu($p_id=0){
        $menu = $this->Menu->find('all', array('conditions' => array('p_id' => $p_id), 'order' => array('odr')));
        return $this->beautifyMenuArray($menu);
    }
    
    private function beautifyMenuArray($menuArray){
        $prettyArray=array();
        foreach($menuArray as $menuArrayItem){ //Making the array prettier
            $prettyArray[]=$menuArrayItem['Menu'];
        }
        return $prettyArray;
    }

}
?>
