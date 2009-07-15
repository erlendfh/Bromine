<?php
class RunrctestsController  extends AppController {
	var $name = 'Runrctests';
	var $helpers = array('Html', 'Form');
	var $layout = "green";
	var $uses = array();
        
    var $runningLimit = 1;
    var $loopLimit = 10000; //Set to -1 for infinite
    var $timeout = 45;
    
    /*
	function gridLauncher($suite_id=0, $tests=array()){ //Depreceated
        //gridLauncer replaces loadBalancer. 
        //gridLauncher just executes all the tests and send them to the grid hub
        //loadBalancer is BR's own grid-alike function that only sends the tests to the nodes when they are ready
         
        session_write_close(); //Needed to avoid race conditions even when using ajax
        
        $hubIP = '127.0.0.1';
        $hubPort = '4444';
        
        $this->log("gridLauncher was called");
        $siteToTest = "http://www.google.com";

        //Should sort out impossible tests before entering this loop! or it's gonna be a long day at the office.
        foreach($tests as $testName => $test){
            foreach($test as $k=>$need){
                //pr($test);
                $OS_id = $need['OS'];
                $browser_id = $need['browser'];
                    
                //Run the test
                $uid = str_replace('.', '', microtime('U')) . rand(0, 1000);
                $this->log("Running test $testName on $OS_id / $browser_id with uid = $uid");

                $this->run($testName, $hubIP . ':' . $hubPort, $OS_id, 80, $browser_id, $siteToTest, 1, $suite_id, $uid);
            }
        }
    }
    */
    
    private function nodes_running($nodes){ //Used in the while loop to determine if there is still nodes running tests 
        foreach($nodes as $node){
            if(!empty($node['Node']['running']))
                return true;
            }
        return false;
    }
    
    private function array_search_recursive($key, $needle, $haystack){
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
    
    private function cmp($a, $b){
        //pr($a = $a['Node']);
        //pr($b = $b['Node']);
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
    
    public function log($msg){
        if ($this->debugmode){
            $fp = fopen('logs/Loadbalancer_output.txt','a');
            fwrite($fp, date('l jS \of F Y h:i:s A'). ': ' . $msg."\n");
            fclose($fp);
        }
    }
    
    private function getFileExt($id){
        App::import('Model','Type');
        $this->Type = new Type();
        $extList = $this->Type->find('list', array('fields' => array('Type.extension')));
        foreach($extList as $ext){
            $file = WWW_ROOT.DS.'testscripts'.DS.$this->Session->read('project_name').DS.$ext.DS.$id.".$ext";
            if(file_exists($file)){
                return $ext;
            }
        }
        return false;
    }
    
    function getAvailableNodes($nodes, $OS_id, $browser_id){
        $availableNodes=array();
        foreach($nodes as $k=>$node){
            if(count($node['Node']['running']) < $this->runningLimit && $this->Node->checkJavaServer($node['Node']['nodepath']) && $this->array_search_recursive('id', $browser_id, $node['Browser'])!==array() && $node['Node']['operatingsystem_id']==$OS_id){
                $availableNodes[$k]=$node;
            }
        }
        return $availableNodes;
    }
    
    function findBestNode($nodes){
        //Algorithm to be debated
        //Current alorithm: Sort by number of browsers as first priority and number of running as second.
        //uasort($nodes,array($this,'cmp'));
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
                    $this->log("Test killed due to timeout of $this->timeout seconds");
                    $customCommand = urlencode("?cmd=customCommand&cmdName=Test terminated&var1=Bromine judged the test unresponsive because no commands had been run for $this->timeout seconds.&var2=The test was terminated to free up the nodes resources.&uid=$uid&test_id=$test_id&status=failed");
                    $handle = fopen("http://127.0.0.1/selenium-server/driver/$customCommand",'r');
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
    
    function runTestcase($requirement_id, $testcase_id){
        App::import('Model','Requirement');
        $this->Requirement = new Requirement();
        $this->Requirement->Behaviors->attach('Containable');
		$requirement = $this->Requirement->find('first', array(
            'conditions'=>array(
                'Requirement.id'=>$requirement_id
            ),
        	'contain'=>array(
        	    'Testcase',
        		'Combination' => array(
        			'Browser',
        			'Operatingsystem'
        		)
        	)
        ));

        $tests = array();

        foreach ($requirement['Combination'] as $combination){
            $tests[$testcase_id][] = array(
                'done' => 0,
                'OS' => $combination['operatingsystem_id'],
                'browser' => $combination['browser_id']
                );
        }

        
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
        $this->loadBalancer($suite_id,$tests);
    }
    
    function runAndViewRequirement($requirement_id){ //Sets up the suite, returns suite_id
        $this->layout = "green_blank";
        $this->set('requirement_id', $requirement_id);
        $suiteName = 'alalal';
        
        App::import('Model','Suite');
        $this->Suite = new Suite();
        $this->data['Suite'] = array(
            'name' => $suiteName,
            'site_id' => $this->Session->read('site_id'),
            'timedate' => null,
            'project_id' => $this->Session->read('project_id')
        );
        $this->Suite->save($this->data);
        $suite_id = $this->Suite->id;
        $this->set('suite_id',$suite_id);
        
        //Find out which tests can't be run. (We do this alot of places yes... maybe some if it is redundant)
        App::import('Model','Node');
        $this->Node = new Node();
        $nodes = $this->Node->find('all');
        $onlineCombinations = array();
        foreach($nodes as $node){
            if($this->Node->checkJavaServer($node['Node']['nodepath'])){
                foreach($node['Browser'] as $browser){
                    $onlineCombinations[] = $node['Operatingsystem']['id'].','.$browser['id'];
                }
            }
        }
        App::import('Model','Requirement');
        $this->Requirement = new Requirement();
        
        $this->Requirement->Behaviors->attach('Containable');
		$requirement = $this->Requirement->find('first', array(
            'conditions'=>array(
                'Requirement.id'=>$requirement_id
            ),
        	'contain'=>array(
        		'Combination' => array(
        			'Browser',
        			'Operatingsystem'
        		),
        		'Testcase'
        	)
        ));
        
        $offlineNeeds =  array();
        foreach($requirement['Combination'] as $combination){
            $idCombination = $combination['Operatingsystem']['id'].','.$combination['Browser']['id'];
            if(!in_array($idCombination,$onlineCombinations)){
                $offlineNeeds[] = $combination['Browser']['name'].' on '.$combination['Operatingsystem']['name'];
            }
        }
        $this->set('offlineNeeds',$offlineNeeds);
    }

    function runRequirement($requirement_id, $suite_id){ //Sorts out offline needs, sets up tests array, calls loadBalancer
        App::import('Model','Requirement');
        $this->Requirement = new Requirement();
        $this->Requirement->Behaviors->attach('Containable');
		$requirement = $this->Requirement->find('first', array(
            'conditions'=>array(
                'Requirement.id'=>$requirement_id
            ),
        	'contain'=>array(
        	    'Testcase',
        		'Combination' => array(
        			'Browser',
        			'Operatingsystem'
        		)
        	)
        ));
        
        App::import('Model','Node');
        $this->Node = new Node();
        $nodes = $this->Node->find('all');
        $onlineNodes = array();
        foreach($nodes as &$node){
            if($this->Node->checkJavaServer($node['Node']['nodepath'])){
                $onlineNodes[] = $node;
            }
        }
        
        $onlineCombinations = array();
        foreach($onlineNodes as $onlineNode){
            foreach($onlineNode['Browser'] as $browser){
                $onlineCombinations[] = $onlineNode['Operatingsystem']['id'].','.$browser['id'];
            }
        }
        
        $tests = array();
        foreach ($requirement['Testcase'] as $testcase){
            $tests[$testcase['id']] = array(); 
            foreach ($requirement['Combination'] as $combination){
                $idCombination = $combination['Operatingsystem']['id'].','.$combination['Browser']['id'];
                if(in_array($idCombination, $onlineCombinations)){ //Sort out the needs that can't be run
                    $tests[$testcase['id']][] = array(
                        'done' => 0,
                        'OS' => $combination['operatingsystem_id'],
                        'browser' => $combination['browser_id']
                        );
                }
            }
        
        }
        $this->loadBalancer($suite_id,$tests);
    }
    
    function loadBalancer($suite_id=0, $tests=array()){
        //loadBalancer is BR's own grid-alike function that sends the tests to the nodes when they are ready
        
        session_write_close(); //Needed for avoiding race conditions even when using ajax
        $this->log("loadBalancer was called with tests = ".print_r($tests,true).", suite_id = $suite_id");
        App::import('Model','Suite');
        $this->Suite = new Suite();
        $this->Suite->recursive = 1;
        $suite = $this->Suite->read(null,$suite_id);
        $siteToTest = $suite['Site']['name']; 
        $this->log("siteToTest: $siteToTest");
        
        App::import('Model','Node');
        $this->Node = new Node();
        $nodes = $this->Node->find('all');
        
        foreach($nodes as &$node){
            $node['Node']['running'] = array();
        }
        
        $i=0;
        //DON'T enter this loop with combination needs you don't have the nodes to handle. You'll get an infinite loop.
        while($this->array_search_recursive('done',0,$tests)!==array() || $this->nodes_running($nodes)){ //While there are tests that has not been run, or nodes still running
            
            $this->log("Doing loop ".$i++);
            foreach($tests as $testName => $test){ //Loop through each test 
                foreach($test as $k=>$need){ //Loop through each need
                    if($need['done']==0){ //If need not done
                        $OS_id = $need['OS'];
                        $browser_id = $need['browser'];
                        $this->log('Need: '.print_r($need,true));
                        $availableNodes = $this->getAvailableNodes($nodes,$OS_id,$browser_id); //Find all available nodes. (not full, right OS and brows)
                        $this->log("available nodes: ".print_r($availableNodes,true));
                        
                        if(!empty($availableNodes)){
                            
                            $bestNodeId = $this->findBestNode($availableNodes); //Find the best node. 
                            $bestNode = $nodes[$bestNodeId];
                            
                            //Run the test
                            $uid = str_replace('.', '', microtime('U')) . rand(0, 1000);
                            $this->log("Running test $testName on $OS_id / $browser_id using resource ".$bestNode['Node']['nodepath']." with uid = $uid");
                            
                            $this->run($testName, $bestNode['Node']['nodepath'], $OS_id, 80, $browser_id, $siteToTest, $suite_id, $uid); //Run the test
                            
                            //Update the need and the node
                            $tests[$testName][$k]['done'] = 1;
                            $nodes[$bestNodeId]['Node']['running'][] = $uid;
                        }
                    }
                }
            }
            sleep(2);
            $nodes = $this->updateNodes($nodes);
            if($this->loopLimit != -1 && $i>$this->loopLimit){
                $this->log("Exceeded loop limit of ".$this->loopLimit." loops. Breaking.");
                break;
            }
        }
    }
	
    function run($testName, $nodePath, $OS_id, $port, $browser_id, $siteToTest, $suite_id, $uid){//Sets up the selenium-server in the DB, puts together the command line string 
        
        //Setup the test in the DB
        App::import('Model','Test');
        App::import('Model','Testcase');
        $this->Test = new Test();
        $this->Testcase = new Testcase();
        $testcase = $this->Testcase->read(null,$testName);
        
        $this->data['Test'] = array(
            'name' => $testcase['Testcase']['name'],
            'operatingsystem_id' => $OS_id,
            'browser_id' => $browser_id,
            'suite_id' => $suite_id,
            'testcase_id' => $testName
        );
        $this->Test->save($this->data);
        $test_id = $this->Test->id;
        
        //Setup the Seleniumserver in the DB for uid/session storage
        App::import('Model','Seleniumserver');
        $this->Seleniumserver = new Seleniumserver();
        $this->data['Seleniumserver']['test_id'] = $test_id;
        $this->data['Seleniumserver']['nodepath'] = $nodePath;
        $this->data['Seleniumserver']['uid'] = $uid;
        $this->Seleniumserver->save($this->data);     
                
        //Setup type variables (extension, spacer and so on)
        $extension = $this->getFileExt($testName);        
        App::import('Model','Type');
        $this->typemodel = new Type();
        $this->types = $this->typemodel->find("extension = '$extension'");
        $name = $this->types['Type']['name'];
        $spacer = $this->types['Type']['spacer'];
        $command = $this->types['Type']['command'];
        
        //Find the browser path
        App::import('Model','Browser');
        $this->Browser = new Browser();
        $browser = $this->Browser->find("id = $browser_id");
        $browserPath = $browser['Browser']['path'];
        
        //Put together the command line string 
        $cmd =  $command . $spacer . WWW_ROOT . 'testscripts' . DS . 
                $this->Session->read('project_name') . DS . $extension . DS . $testName . '.' . $extension . 
                $spacer . '127.0.0.1' . $spacer . $port . $spacer . $browserPath . $spacer . 
                $siteToTest . $spacer . $uid . $spacer . $test_id;
        //Execute it
        $this->execute($cmd, $uid);
    }
    
    
    private function execute($cmd, $uid) {
        $this->log("Executing: $cmd");
        
        if (substr(php_uname(), 0, 7) == "Windows"){ //Windows
            $this->log('Output printed to logs/output/'.$uid.'txt');
            $this->log(pclose(popen("start /B ". $cmd . ' > logs/output' . $uid . '.txt', "r"))); 
            
        }
        else { //Unix. NEVER TESTED IN UNIX
            exec($cmd . " > /dev/null &");  
        }
    }

    
    function directoryToArray($directory, $recursive) {
    	$array_items = array();
    	if ($handle = opendir($directory)) {
    		while (false !== ($file = readdir($handle))) {
    			if ($file != "." && $file != ".." ) {
    				if (is_dir($directory. "/" . $file)) {
    					if($recursive) {
    						$array_items = array_merge($array_items, $this->directoryToArray($directory. "/" . $file, $recursive));
    					}
    					$file = $directory . "/" . $file;
    					$array_items[] = preg_replace("/\/\//si", "/", $file);
    				} else {
    					$file = $directory . "/" . $file;
    					$array_items[] = preg_replace("/\/\//si", "/", $file);
    				}
    			}
    		}
    		closedir($handle);
    	}
    	return $array_items;
    }
    
    function stateOfTheSystem(){
        
        $state = array();
        $output = array();
        $state['Permissions output'] = "";
        //pr($this->directoryToArray('testscripts/eniro/',true));
        
        // Test for Java
        exec('java -version', $java_output, $java_return);
        $state['Java'] = $java_return;
        $output['Java'] = implode(",", $java_output);
        
        // Test for Ruby
        exec('ruby -v', $ruby_output, $ruby_return);
        $state['Ruby'] = $ruby_return;
        $output['Ruby'] = implode(",", $ruby_output);
        
        // Test for PHP
        exec('php --version', $php_output, $php_return);
        $state['Php'] = $php_return;
        $output['Php'] = implode(",", $php_output);
        
        // Test for Magic Quotes
        $mq_return = get_magic_quotes_gpc();
        $state['Magic Quotes'] = $mq_return;
        
        // Test for Max execution time
        $max_exec_time = ini_get('max_execution_time');
        $state['Max execution time'] = $max_exec_time;
        
        // Test for filepermissions
        //echo getcwd();
        $permission2 = is_writeable("testscripts/".$this->Session->read('project_name'));
        $permission3 = is_writeable("logs");
        $permission4 = is_writeable("img/temp");
        
        App::import('Model','Type');
        $this->Type = new Type();
        $extList = $this->Type->find('list', array('fields' => array('Type.extension')));
        
        foreach ($extList as $value) {
        	if(!is_writeable("testscripts/".$this->Session->read('project_name')."/".$value)){
                $state['Permissions'] = false;
                $state['Permissions output'] = $state['Permissions output'] . ", testscripts/".$this->Session->read('project_name')."/".$value;
            }
        }
        
        $state['Logs dir'] = $permission3;
        $state['Img/temp dir'] = $permission4;
        $this->set('current_project',$this->Session->read('project_name'));
        
        
        // Set the arrays for the viewer
        $this->set('state',$state);
        $this->set('output',$output);
        
        
    }
    
}
?>
