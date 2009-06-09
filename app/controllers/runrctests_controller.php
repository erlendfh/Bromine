<?php
class RunrctestsController  extends AppController {
	var $name = 'Runrctests';
	var $helpers = array('Html', 'Form');
	var $layout = "green";
	var $uses = array();
        
    var $runningLimit = 1;
    var $timeout = 60;
    
    /*
     
    
    
    */
    
    function index() {
    
        App::import('Model','Node');
        $this->Node = new Node();
        $this->Node->recursive = 1;
        pr($this->Node->find('all')); 
        //$this->set('browsers', $this->paginate());
        App::import('Model','Type');
        $this->typemodel = new Type();
        $this->types = $this->typemodel->find('all',array('name'));
        foreach ($this->types as $type){
            $this->set($type['Type']['name'], $this->dirList(WWW_ROOT . 'testscripts' . DS . $this->Session->read('project_name') . DS . $type['Type']['name'] . DS , $type['Type']['extension']));
        }
	}
    
    function array_search_recursive($key, $needle, $haystack){
        $path=array();
        foreach($haystack as $id => $val){
         if($val == $needle && $id == $key)
              $path[]=$id;
         else if(is_array($val)){
             $found=$this->array_search_recursive($key, $needle, $val);
              if(count($found)>0){
                  $path[$id]=$found;
              }       
          }
        }
        return $path;
    }
    
    function cmp($a, $b){
        $a = $a['Node'];
        $b = $b['Node'];
        $field_1 = 'Browser';
        $field_2 = 'running';
        
        if(count($a[$field_1]) == count($b[$field_1])){
            if(count($a[$field_2]) == count($b[$field_2])){
                return 0;
            }
            elseif(count($a[$field_2]) > count($b[$field_2])){
                return 1;
            }
            elseif(count($a[$field_2]) < count($b[$field_2])){
                return -1;
            }
        }
        elseif(count($a[$field_1]) > count($b[$field_1])){
            return 1;
        }
        elseif(count($a[$field_1]) < count($b[$field_1])){
            return -1;
        }
    }
    
    function log($msg){
        $fp = fopen('log2.txt','a');
        fwrite($fp, time(). ': ' . $msg."\n");
        fclose($fp);
    }
    
    function getAvailableNodes($nodes, $OS_id, $browser_id){
        $availableNodes=array();
        foreach($nodes as $k=>$node){
            if(count($node['Node']['running']) < $this->runningLimit && $this->array_search_recursive('id', $browser_id, $node['Browser'])!==array() && $node['Node']['operatingsystem_id']==$OS_id){
                $availableNodes[$k]=$node;
            }
        }
        return $availableNodes;
    }
    
    function findBestNode($nodes){
        //Algorithm to be debated
        //Current alorithm: Sort by number of browsers as first priority and number of running as second.
        uasort($nodes,array($this,'cmp'));
        return current(array_keys($nodes));
    }
    
    function updateNodes($nodes){
        App::import('Model','Seleniumserver');
        $this->Seleniumserver = new Seleniumserver();
        
        foreach($nodes as $k=>$node){
            foreach($node['Node']['running'] as $j=>$uid){
                $currentTime = time();
                $seleniumServer = $this->Seleniumserver->find("uid = '$uid'");
                $lastCommand = $seleniumServer['Seleniumserver']['lastCommand'];
                $sessionId = $seleniumServer['Seleniumserver']['session'];
                $test_id = $seleniumServer['Seleniumserver']['test_id'];
                $done = $seleniumServer['Seleniumserver']['done'];
                if((time() - $lastCommand) > $this->timeout && $lastCommand != 0){ //The test has not run commands for timeout seconds
                    $handle = fopen("http://127.0.0.1/selenium-server/driver/?cmd=customCommand&cmdName=Test terminated&var1=Bromine judged the test unresponsive because no commands had been run for $this->timeout seconds.&var2=The test was terminated to free up the nodes resources.&uid=$uid&test_id=$test_id&status=failed",'r');
                    $handle = fopen("http://127.0.0.1/selenium-server/driver/?cmd=testComplete&sessionId=$sessionId",'r');
                    fclose($handle);
                    unset($nodes[$k]['Node']['running'][$j]);
                }
                if($done){
                    unset($nodes[$k]['Node']['running'][$j]);
                }
            }
        }
        return $nodes;
    }
    
    function loadBalancer($suite_id, $tests=array()){
        session_write_close();
        $this->log("loadBalancer was called with tests = $tests, suite_id = $suite_id");
        $siteToTest = "http://www.google.com";
        $tests = array(
        '1' =>  
            array(
                array(
                    'done' => 0,
                    'OS' => 12,
                    'browser' => 3
                )/*,
                array(
                    'done' => 0,
                    'OS' => 12,
                    'browser' => 3
                )
                /*,
                array(
                    'done' => 0,
                    'OS' => 4,
                    'browser' => 13
                )*/
            ),
        '3' =>
            array(
                array(
                    'done' => 0,
                    'OS' => 12,
                    'browser' => 2
                )/*,
                array(
                    'done' => 0,
                    'OS' => 12,
                    'browser' => 3
                )
                /*,
                array(
                    'done' => 0,
                    'OS' => 4,
                    'browser' => 13
                ),
                array(
                    'done' => 0,
                    'OS' => 4,
                    'browser' => 3
                )
                */
            )
        );
        App::import('Model','Node');
        $this->Node = new Node();
        $nodes = $this->Node->find('all');
        foreach($nodes as &$node){
            $node['Node']['running'] = array();
        }
        
        $i=0;
        //Should sort out impossible tests before entering this loop! or it's gonna be a long day at the office.
        while($this->array_search_recursive('done',0,$tests)!==array()){
            $this->log("Doing loop ".$i++);
            foreach($tests as $testName => $test){
                foreach($test as $k=>$need){
                    if($need['done']==0){
                        $OS_id = $need['OS'];
                        $browser_id = $need['browser'];
                        //Find all available nodes. (not full, right OS and brows)
                        $this->log('Need: '.print_r($need,true));
                        $availableNodes = $this->getAvailableNodes($nodes,$OS_id,$browser_id);
                        foreach($availableNodes as $lala)
                        $this->log("available node: ".print_r($lala['Node'],true));
                        if(!empty($availableNodes)){
                            //Find the best node. 
                            $bestNodeId = $this->findBestNode($availableNodes);
                            $bestNode = $nodes[$bestNodeId];
                            
                            //Run the test
                            $uid = str_replace('.', '', microtime('U')) . rand(0, 1000);
                            $this->log("Running test $testName on $OS_id / $browser_id using resource ".$bestNode['Node']['nodepath']." with uid = $uid");
                            
                            
                            $this->run($testName, $bestNode['Node']['nodepath'], $OS_id, 80, $browser_id, $siteToTest, 1, $suite_id, $uid);
                            
                            //Update the need and the node
                            $tests[$testName][$k]['done'] = 1;
                            $nodes[$bestNodeId]['Node']['running'][] = $uid;
                        }
                    }
                }
            }
            sleep(2);
            $nodes = $this->updateNodes($nodes);
        }
    }
	
	function status($suite_id){    
        App::import('Model','Suite');
        $this->Suite = new Suite();
        $this->Suite->recursive = 2;
        $this->set('Suite',$this->Suite->find("Suite.id = $suite_id"));
    }
	
	function start($tests=array()){
	
        $site_id = 37;
        $siteToTest = 'http://www.google.dk';
        $suiteName = 'alalal';
        
        App::import('Model','Suite');
        $this->Suite = new Suite();
        $this->data['Suite'] = array(
            'name' => $suiteName,
            'site_id' => $site_id,
            'timedate' => null,
            'project_id' => $this->Session->read('project_id')
        );
        $this->Suite->save($this->data);
        $suite_id = $this->Suite->id;
        $this->set('suite_id',$suite_id);
        $this->set('tests',$tests);
        $this->set('siteToTest',$siteToTest);
    }
	
    private function initiate($test_id, $nodePath, $uid){
        App::import('Model','Seleniumserver');
        $this->Seleniumserver = new Seleniumserver();
        if ($test_id != '' && $nodePath != ''){
            $this->data['Seleniumserver']['test_id'] = $test_id;
            $this->data['Seleniumserver']['nodepath'] = $nodePath;
            $this->data['Seleniumserver']['uid'] = $uid;
            
            $this->Seleniumserver->save($this->data);
            return true;
        }else{
            return false;
        } 
    }
    

    function run($testName, $nodePath, $OS_id, $port, $browser_id, $siteToTest, $type_id, $suite_id, $uid){
        App::import('Model','Test');
        $this->Test = new Test();
        //`id` ,  `status` ,  `name` ,  `suite_id` ,  `help` ,  `manstatus` ,  `author` ,  `browser_id` ,  `operatingsystem_i
        $this->data['Test'] = array(
            'name' => $testName,
            'operatingsystem_id' => $OS_id,
            'browser_id' => $browser_id,
            'suite_id' => $suite_id
        );
         
        $this->Test->save($this->data);
        $test_id = $this->Test->id;
        
        if ($this->initiate($test_id, $nodePath, $uid)===false){
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
        
        App::import('Model','Browser');
        $this->Browser = new Browser();
        $browser = $this->Browser->find("id = $browser_id");
        $browserPath = $browser['Browser']['path'];
        
        $cmd =  $command . $spacer . WWW_ROOT . 'testscripts' . DS . 
                $this->Session->read('project_name') . DS . $name . DS . $testName . '.' . $extension . 
                $spacer . '127.0.0.1' . $spacer . $port . $spacer . $browserPath . $spacer . 
                $siteToTest . $spacer . $uid . $spacer . $test_id;
        $this->execute($cmd);
    }
    
    // Function downloaded from php.net. NEVER TESTED IN UNIX
    private function execute($cmd) {
        $this->log("Executing: $cmd");
        //Windows
        
        $this->log(substr(php_uname(), 0, 7));
        
        if (substr(php_uname(), 0, 7) == "Windows"){
            pclose(popen("start /B ". $cmd, "r")); 
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
