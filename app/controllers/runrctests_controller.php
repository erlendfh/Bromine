<?php
class RunrctestsController  extends AppController {
	var $name = 'Runrctests';
	var $helpers = array('Html', 'Form');
	var $layout = "green";
	var $uses = array();
	
	var $tests = array(
        'lala' =>  
            array(
                array(
                    'done' => 0,
                    'OS' => 'XP',
                    'browser' => 'firefox'
                ),
                array(
                    'done' => 0,
                    'OS' => 'XP',
                    'browser' => 'ie7'
                ),
                array(
                    'done' => 0,
                    'OS' => 'OSX',
                    'browser' => 'safari'
                )
            ),
        'trille' =>
            array(
                array(
                    'done' => 0,
                    'OS' => 'XP',
                    'browser' => 'firefox'
                ),
                array(
                    'done' => 0,
                    'OS' => 'XP',
                    'browser' => 'ie7'
                ),
                array(
                    'done' => 0,
                    'OS' => 'OSX',
                    'browser' => 'safari'
                ),
                array(
                    'done' => 0,
                    'OS' => 'OSX',
                    'browser' => 'firefox'
                )
            )
        );
    var $nodes = array(
        4 => array(
            'Node' => array(
                'name' => 'XP node1', 
                'running' => array(),
                'OS' => 'XP',
                'ip' => '192.168.0.1',
                'browsers' => array(
                    'firefox',
                    'ie7'
                )
            )
        ),
        5 => array(
            'Node' => array(
                'name' => 'XP node2',
                'running' => array(),
                'OS' => 'XP',
                'ip' => '192.168.0.2',
                'browsers' => array(
                    'firefox'
                    //'ie7'
                )
            )
        ),
        6 => array(
            'Node' => array(
                'name' => 'Mac node',
                'running' => array(),
                'OS' => 'OSX',
                'ip' => '192.168.0.3',
                'browsers' => array(
                    'firefox',
                    'safari'
                )
            )
        )
    );
        
    var $runningLimit = 1;
    
    function array_search_recursive($key, $needle, $haystack){
        $path=array();
        foreach($haystack as $id => $val){
         if($val === $needle && $id == $key)
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
        $field_1 = 'browsers';
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
        $fp = fopen('logs/thelog.txt','a');
        fwrite($fp, $msg."\n");
        fclose($fp);
    }
    
    function getAvailableNodes($OS, $browser){
        $availableNodes=array();
        foreach($this->nodes as $k=>$node){
            if(count($node['Node']['running'])<$this->runningLimit && in_array($browser, $node['Node']['browsers']) && $node['Node']['OS']==$OS){
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
    
    function updateNodes(){
        foreach($this->nodes as $k=>$node){
            foreach($node['Node']['running'] as $j=>$uid){
                if(file_exists("logs/log$uid.txt")){
                    unset($this->nodes[$k]['Node']['running'][$j]);    
                }
            }
        }
    }
    
    function test(){
        $i=0;
        while($this->array_search_recursive('done',0,$this->tests)!==array()){
            $this->log("Doing loop ".$i++);
            foreach($this->tests as $testname => $test){
                foreach($test as $k=>$need){
                    if($need['done']==0){
                        //Find all available nodes. (not full, right OS and brows)
                        $availableNodes = $this->getAvailableNodes($need['OS'],$need['browser']);
                        if(!empty($availableNodes)){
                            //Find the best node. 
                            $bestNodeId = $this->findBestNode($availableNodes);
                            $bestNode = $this->nodes[$bestNodeId];
                            
                            //Run the test
                            $uid = rand(0,999999999);
                            $this->log("Running test $testname on ".$need['OS']." / ".$need['browser']." using resource ".$bestNode['Node']['name']." with uid = $uid");
                            pclose(popen("start /B php lala.php $uid",'r'));
                            
                            //Update the need and the node
                            $this->tests[$testname][$k]['done'] = 1;
                            $this->nodes[$bestNodeId]['Node']['running'][] = $uid;
                        }
                    }
                }
            }
            sleep(1);
            $this->updateNodes();
        }
    }
	
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
