<?php
class RunrctestsController  extends AppController {
	var $name = 'Runrctests';
	var $helpers = array('Html', 'Form');
	var $layout = "green";
	var $uses = array();
	function index() {
        //$this->set('browsers', $this->paginate());
        App::import('Model','Type');
        $this->typemodel = new Type();
        $this->types = $this->typemodel->find('all',array('name'));
        foreach ($this->types as $type){
            $this->set($type['Type']['name'], $this->dirList(WWW_ROOT . 'tests' . DS . $this->Session->read('project_name') . DS . $type['Type']['name'] . DS , $type['Type']['extension']));
        }
	}
    private function initiate($test_id, $nodepath){
        /*
        $vars = $this->params['named'];
        $test_id = $vars['test_id'];
        $nodepath = $vars['nodepath'];
        */
        App::import('Model','Seleniumserver');
        $this->Seleniumserver = new Seleniumserver();
        if ($test_id != '' && $nodepath != ''){
            $uid = str_replace('.', '', microtime('U')) . rand(0, 1000);
            //echo $uid;
            $this->data['Seleniumserver']['test_id'] = $test_id;
            $this->data['Seleniumserver']['nodepath'] = $nodepath;
            $this->data['Seleniumserver']['uid'] = $uid;
            
            $this->Seleniumserver->save($this->data);
            return $uid;
        }else{
            return false;
        } 
    }
    function run(){
        $vars = $this->params['named'];
        $this->set('vars', $vars);
        
        /*
        $host = $argv[1];
        $port = $argv[2];
        $browser = $argv[3];
        $sitetotest = $argv[4];
        $uid = $argv[5];
        $test_id = $argv[6];
        
        */
        $testname = $vars['testname'];
        $host = $vars['host'];
        $port = $vars['port'];
        $browser = $vars['browser'];
        $sitetotest = 'http://'.$vars['sitetotest'];
        $test_id = $vars['test_id'];
        $type_id = $vars['type_id'];
        
        $uid = $this->initiate($test_id, $host);
        if ($uid === false){
            $this->Session->setFlash(__('Test_id and/or $host is not set!', true));
            $this->redirect(array('action'=>'index'));
        }
        
        App::import('Model','Type');
        $this->typemodel = new Type();
        
        $this->types = $this->typemodel->find("id = $type_id");
        
        $name = $this->types['Type']['name'];
        $spacer = $this->types['Type']['spacer'];
        $extension = $this->types['Type']['extension'];
        $command = $this->types['Type']['command'];
        
        $cmd =  $command . $spacer . WWW_ROOT . 'tests' . DS . 
                $this->Session->read('project_name') . DS . $name . DS . $testname .
                $spacer . $host . $spacer . $port . $spacer . $browser . $spacer . 
                $sitetotest . $spacer . $uid . $spacer . $test_id;
        echo $cmd;        
        $this->execute ($cmd);
        
    }
    
    // Function downloaded from php.net. NEVER TESTED IN UNIX
    private function execute($cmd) {
        //Windows
        if (substr(php_uname(), 0, 7) == "Windows"){
            pclose(popen("start /B ". $cmd . "> visti.txt", "r")); 
        }
        //Unix
        else {
            exec($cmd . " > /dev/null &");  
        }
    }
    
    private function dirList ($directory,$ext) 
{
    // create an array to hold directory list
    $results = array();
    // create a handler for the directory
    $handler = opendir($directory);
    // keep going until all files in directory have been read
    while ($file = readdir($handler)) {
        // if $file isn't this directory or its parent, 
        // add it to the results array
        if ($file != '.' && $file != '..')
            if (end(explode('.',$file)) == $ext)
            {
                $results[] = $file;
            }
    }
    // tidy up: close the handler
    closedir($handler);
    // done!
    return $results;
}
}
?>