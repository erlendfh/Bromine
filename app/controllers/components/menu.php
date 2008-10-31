<?php
/*
TODO:
1) Create view/controllers for menuProject, menuTestLab, menuTestPlan and so on
2) Controllers for above should set session current_main_menu_id
3) Fix submenu part
*/
class MenuComponent extends Component{
    public $components = array('Acl', 'Auth');
    function __construct(){
        App::import('Model', 'Menu');
        $this->Menu = new Menu();
    }

    function createMainMenu(){
        $mainMenu = $this->Menu->find('all', array('conditions' => array('p_id' => 0), 'order' => array('odr')));
        if(is_array($mainMenu = $this->checkAcl($mainMenu))){
            return $mainMenu;
        }
    }
    
    function createSubMenu(){ //Not working yet
        
        return $this->Menu->find('all', array( 'conditions' => array('p_id' => $this->session['current_main_menu_id'])));
    }
    
    private function beautifyMenuArray($menuArray){
        foreach($menuArray as $menuArrayItem){ //Making the array prettier
            $prettyArray[]=$menuArrayItem['Menu'];
        }
        return $prettyArray;
    }
    
    private function checkAcl($array){
        $aro = $this->Auth->user();
        $acos = $this->beautifyMenuArray($array);
        $menu=array();
        foreach($acos as $aco){
            if(@$this->Acl->check($aro['User']['name'],"controllers".$aco['link'])){
                $menu[] = $aco;
            }
        }
        return $menu;
    }
}
?>
