<?php
class BuildAclController extends AppController {

	var $name = 'BuildAcl';
    var $uses = null;
    
	function index() {
        App::import('Model','Project');
        $this->Project = new Project();
        $this->Project->recursive = 0;
        
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
        
        $projects = $this->Project->find('all');
        foreach($projects as $project){
            $project = $project['Project']['name'];
            $projectFind = $aco->find(array('alias'=>'/everything/'.$project));
            if (!$projectFind) {
                $aco->create(array('parent_id' => $root['id'], 'alias' => "/everything/$project"));
                $aco->save();
                $log[] = "Created Aco node for /everything/$project";
            }
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
        $this->set('msg',$log);
    }

}
?>
