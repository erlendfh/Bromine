<?php


class RequirementsController extends AppController {

	var $name = 'Requirements';
	var $helpers = array('Html', 'Form','Tree');
    var $needsproject = true;
    var $paginate = array(
        'limit' => 25,
        'order' => array(
            'Requirement.priority' => 'asc',
            'Requirement.nr' => 'asc'
        )
    );
    
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
    
     function reorder($id=null,$parent_id=null){
        if(isset($id) && isset($parent_id)){
            $this->data['Requirement']['id'] = $id;
            $this->data['Requirement']['parent_id'] = $parent_id;
            $this->Requirement->save($this->data);
        }
    }
    
	function index() {
		$this->Requirement->recursive = 0;
		$this->set('data',$this->Requirement->find('threaded'));
		//$this->set('requirements', $this->paginate(null, array('project.id' => $this->Session->read('project_id'))));
		
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Requirement.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('requirement', $this->Requirement->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Requirement->create();
			if ($this->Requirement->save($this->data)) {
				$this->Session->setFlash(__('The Requirement has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Requirement could not be saved. Please, try again.', true));
			}
		}
		$testcases = $this->Requirement->Testcase->find('list');
		$this->set(compact('testcases'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Requirement', true));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Requirement->save($this->data)) {
				$this->Session->setFlash(__('The Requirement has been saved', true));
				$this->redirect(array('action'=>'index'));
			} else {
				$this->Session->setFlash(__('The Requirement could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Requirement->read(null, $id);
		}
		$testcases = $this->Requirement->Testcase->find('list');
		$this->set(compact('testcases'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Requirement', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Requirement->del($id)) {
			$this->Session->setFlash(__('Requirement deleted', true));
			$this->redirect(array('action'=>'index'));
		}
	}

}
?>
