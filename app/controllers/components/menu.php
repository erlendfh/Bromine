<?php
class MenuComponent{

    var $components = array('Acl', 'Auth');
    function __construct(){
        App::import('Model', 'Menu');
        $this->Menu = new Menu();
    }

    function createMenu($p_id=0){
        $menu = $this->Menu->find('all', array('conditions' => array('p_id' => $p_id), 'order' => array('odr')));
        return $this->checkAcl($menu);
    }
    
    private function beautifyMenuArray($menuArray){
        $prettyArray=array();
        foreach($menuArray as $menuArrayItem){ //Making the array prettier
            $prettyArray[]=$menuArrayItem['Menu'];
        }
        return $prettyArray;
    }
    
    private function checkAcl($array=array()){
        $aro = $this->Auth->user('name');
        $acos = $this->beautifyMenuArray($array);
        $menu=array();
        foreach($acos as $aco){
            if($this->Acl->check($aro,'controllers'.'/'.$aco['controller'].'/'.$aco['action'])){
                $menu[] = $aco;
            }
        }
        return $menu;

    }
}
?>
