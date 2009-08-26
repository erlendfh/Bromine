<?php
class PluginsController extends AppController {

	var $name = 'Plugins';
	var $helpers = array('Html', 'Form');

	function index(){
		$this->Plugin->recursive = 0;
		
		$dbPluginList = $this->Plugin->find('list');
		
		$dirPluginList = array();
        if ($handle = opendir(ROOT.DS.'app'.DS.'plugins')) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != ".." && $file != '.svn') {
                    $dirPluginList[] = $file;
                }
            }
            closedir($handle);
        }
        $notInstalled = array_diff($dirPluginList, $dbPluginList);
        
        $noFiles = array_diff($dbPluginList, $dirPluginList);
        
        $this->Plugin->deleteAll(array( //Clean up DB entries with no plugin folder
                'Plugin.id' => array_keys($noFiles)
            ));
        
        $plugins = $this->paginate();
        App::import('Xml');
        foreach($plugins as &$plugin){
            $xml = new Xml(file_get_contents(ROOT.DS.'app'.DS.'plugins'.DS.$plugin['Plugin']['name'].DS.'meta.xml'));
            $plugin['Plugin']['author'] = $xml->child('plugin')->child('author')->children[0]->value;
            $plugin['Plugin']['email'] = $xml->child('plugin')->child('email')->children[0]->value;
            $plugin['Plugin']['website'] = $xml->child('plugin')->child('website')->children[0]->value;
            $plugin['Plugin']['description'] = $xml->child('plugin')->child('description')->children[0]->value;
        }
        $this->set('plugins', $plugins);
        
        foreach($notInstalled as $k => &$plugin){
            $plugin_name = $plugin;
            $plugin = array();
            $meta = ROOT.DS.'app'.DS.'plugins'.DS.$plugin_name.DS.'meta.xml';
            if(file_exists($meta)){
                $xml = new Xml(file_get_contents($meta));
                $plugin['Plugin']['name'] = $plugin_name;
                $plugin['Plugin']['author'] = $xml->child('plugin')->child('author')->children[0]->value;
                $plugin['Plugin']['email'] = $xml->child('plugin')->child('email')->children[0]->value;
                $plugin['Plugin']['website'] = $xml->child('plugin')->child('website')->children[0]->value;
                $plugin['Plugin']['description'] = $xml->child('plugin')->child('description')->children[0]->value;
            }else{
                 unset($notInstalled[$k]);
            }
        }
        $this->set('notInstalled', $notInstalled);
	}
    
    function install($plugin){
        if(($output = $this->requestAction("$plugin/install/install")) === true ){
            $data['Plugin']['name'] = $plugin;
            $data['Plugin']['activated'] = 1;
            if(!$this->Plugin->save($data)){
                $output = 'The plugin installed correctly, but Bromine couldn\'t insert the plugin in the database.';
            }
            //Set relevant ACL entries
        }
        $this->set('output', $output);
    }
    
    function uninstall($plugin_id){
        $plugin = $this->findById($plugin_id);
        $plugin = $plugin['name'];
        if(($output = $this->requestAction("$plugin/install/uninstall")) === true ){
            if(!$this->Plugin->del($id)){
                $output = 'The plugin uninstalled correctly, but Bromine couldn\'t remove the plugin from the database.';
            }
            //Remove relevant ACL entries
            //Unlink folder
        }
        $this->set('output', $output);
    }
    
    function activate($plugin_id){
        $data['Plugin']['id'] = $plugin_id;
        $data['Plugin']['activated'] = 1;
        if(!$this->Plugin->save($data)){
            $this->Session->setFlash('There was an error, try again');
        }
        $this->redirect(array('action'=>'index'));        
    }
    
    function deactivate($plugin_id){
        $data['Plugin']['id'] = $plugin_id;
        $data['Plugin']['activated'] = 0;
        if(!$this->Plugin->save($data)){
            $this->Session->setFlash('There was an error, try again');
        }
        $this->redirect(array('action'=>'index'));        
    }   

}
?>