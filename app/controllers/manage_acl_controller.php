<?php
class ManageAclController extends AppController {

	var $name = 'ManageAcl';
	var $helpers = array('Html', 'Form', 'Ajax', 'Javascript');
	var $uses = array('Myaro', 'Myaco');
	var $main_menu_id = -2;

	function index(){
	   //var_dump($this->MyAcl->hasAccess(21,'/browsers/view'));
    }
    
	function listAros($parent_id = null){
		$this->set('CurrentAros', $this->Myaro->read(null,$parent_id));
		$this->Myaro->recursive = 0;
		$this->set('Aros', $this->Myaro->find('all',array('conditions'=>array('parent_id'=>$parent_id),'order'=>'alias')));
	}
	
	function createACL($aro_id, $aco_id, $access){
	    App::import('Sanitize');
	    list($aro_id, $aco_id, $access) = Sanitize::clean(array($aro_id, $aco_id, $access));
        $this->Myaro->query("
           INSERT INTO myaros_myacos (id, myaro_id, myaco_id, access)
           VALUES (NULL, $aro_id, $aco_id, $access)
           ON DUPLICATE KEY UPDATE access = $access
        ");
    }
    
    function removeACL($aro_id, $aco_id){
        App::import('Sanitize');
	    list($aro_id, $aco_id) = Sanitize::clean(array($aro_id, $aco_id));
        $this->Myaro->query("
           DELETE FROM myaros_myacos WHERE myaro_id = $aro_id AND myaco_id = $aco_id
        ");
    }

	function listAcos($aro = null){
		if(!empty($aro)){
            $this->set('id', $aro);
            $acos = $this->Myaco->find('threaded',array(
                'contain' => array()
            ));
		  
            $data = $this->Myaro->find('first', array(
                    'conditions' => array(
                        'Myaro.id' => $aro
                    )              
                ));
            
            $aros = split('/',$data['Myaro']['alias']);
            if(count($aros)>2){
                $group = $aros[1];
                $group = $this->Myaro->find('first',array(
                    'conditions' => array(
                        'Myaro.alias' => '/'.$group
                    )
                ));
                $inherited = $this->Myaro->find('first', array(
                    'conditions' => array(
                        'Myaro.id' => $group['Myaro']['id']
                    )              
                ));
                $inherited_list = array();
                foreach($inherited['Myaco'] as $aco){
                    $inherited_list[$aco['alias']] = array(
                        'id' => $aco['id'],
                        'access' => $aco['MyarosMyaco']['access']
                    );     
                }
                $this->set('inherited', $inherited_list);
            }
            $personal_list = array();
            foreach($data['Myaco'] as $aco){
                $personal_list[$aco['alias']] = array(
                    'id' => $aco['id'],
                    'access' => $aco['MyarosMyaco']['access']
                );     
            }
            $this->set('personal', $personal_list);
            $this->set('acos', $acos);  
        }
	}
	
	function buildAcl(){
            $log = array();
     
            $aco = $this->MyAcl->Myaco;
            $aco->recursive = 0;
            $root = $aco->find(array('alias'=>'/everything'));
    
            if (!$root) {
                $aco->create(array('parent_id' => null, 'model' => null, 'alias' => '/everything'));
                $root = $aco->save();
                $root['id'] = $aco->id; 
                $log[] = 'Created Aco node for /everything';
            } else {
                $root = $root['Myaco'];
            }          
            
            App::import('Core', 'File');
            $Controllers = Configure::listObjects('controller');
            $appIndex = array_search('App', $Controllers);
            if ($appIndex !== false ) {
                unset($Controllers[$appIndex]);
            }
            $baseMethods = get_class_methods('Controller');
            $baseMethods[] = 'buildAcl';
     
            // look at each controller in app/controllers
            foreach ($Controllers as $ctrlName) {
                App::import('Controller', $ctrlName);
                $ctrlclass = $ctrlName . 'Controller';
                $methods = get_class_methods($ctrlclass);
                
                // find / make controller node
                
                $controllerNode = $aco->find(array('alias'=>'/everything/'.$ctrlName));
                if (!$controllerNode) {
                    $aco->create(array('parent_id' => $root['id'], 'alias' => "/everything/$ctrlName"));
                    $controllerNode = $aco->save();
                    $controllerNode['id'] = $aco->id;
                    $log[] = "Created Aco node for /everything/$ctrlName";
                } else {
                    $controllerNode = $controllerNode['Myaco'];
                }
                
                //clean the methods. to remove those in Controller and private actions.
                foreach ($methods as $k => $method) {
                    if (strpos($method, '_', 0) === 0) {
                        unset($methods[$k]);
                        continue;
                    }
                    if (in_array($method, $baseMethods)) {
                        unset($methods[$k]);
                        continue;
                    }
                }
                
                
                foreach ($methods as $method) {
                    $methodNode = $aco->find(array('alias'=>'/everything/'.$ctrlName.'/'.$method));
                    if (!$methodNode) {
                        $aco->create(array('parent_id' => $controllerNode['id'], 'alias' => "/everything/$ctrlName/$method"));
                        $methodNode = $aco->save();
                        $log[] = "Created Aco node for /everything/$ctrlName/$method";
                    }
                }
                
            }
            $this->set('log',$log);
        }

}
?>
