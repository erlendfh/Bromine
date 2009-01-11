<?php
class MyAclComponent{
    //var $uses = array('Aro', 'Aco');
    function __construct(){
        App::import('Model', 'Myaco');
        App::import('Model', 'Myaro');
        App::import('Model', 'User');
        $this->Myaco = new Myaco();
        $this->Myaro = new Myaro();
        $this->User = new User();
    }
    
	function hasAccess($aro, $aco){
        //pr($aro);pr($aco);
        $this->Myaco->recursive = 1;
        $this->Myaro->recursive = 1;
        
        $aco=split('/',$aco);
        $aco[0]='everything';
        
        $arofind = $this->User->find(array('User.id'=>$aro));
        $aro = null;
        $aro[0] = '/'.$arofind['Group']['name'];
        $aro[1] = $aro[0] . '/' . $arofind['User']['name'];
        //pr($aro);
        
        
        for($i=count($aco);$i>0;$i--){
            $newaco='';
            for($u=0;$u<$i;$u++){
                $newaco .= '/'.$aco[$u];
            }
            //pr($newaco);
            if(($list=$this->Myaco->find(array('alias'=>$newaco)))!==false && !empty($list['Myaro'])){ //The ACO exsits
                //echo "called";pr($list);
                foreach($list['Myaro'] as $thisaro){
                    if (in_array($thisaro['alias'], $aro)){
                        return true;
                    }
                    
                }
            }
        }
        return false;
        
    }
   
}
?>
