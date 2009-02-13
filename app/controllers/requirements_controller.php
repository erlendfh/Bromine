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
    function reorder($id=null,$parent_id=null){
        if(isset($id) && isset($parent_id)){
            $this->data['Requirement']['id'] = $id;
            $this->data['Requirement']['parent_id'] = $parent_id;
            $this->Requirement->save($this->data);
        }

    }
    function array_search_recursive($key, $needle, $haystack){
        $path=array();
        foreach($haystack as $id => $val)
        {
        
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
    
    function test(){
    
        $tests = array(
            'done' => false,
            'tests' => array(
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
                )
            );
        $nodes = array(

                0 => array(
                    'Node' => array(
                        'name' => 'XP node1', 
                        'running' => 0,
                        'OS' => 'XP',
                        'ip' => '192.168.0.1',
                        'browsers' => array(
                            'firefox',
                            'ie7'
                        )
                    )
                ),
                1 => array(
                    'Node' => array(
                        'name' => 'XP node2',
                        'running' => 0,
                        'OS' => 'XP',
                        'ip' => '192.168.0.2',
                        'browsers' => array(
                            'firefox'
                            //'ie7'
                        )
                    )
                ),
                2 => array(
                    'Node' => array(
                        'name' => 'Mac node',
                        'running' => 0,
                        'OS' => 'OSX',
                        'ip' => '192.168.0.3',
                        'browsers' => array(
                            'firefox',
                            'safari'
                        )
                    )
                )

        );
        $runningLimit = 1;
        $running = array();
        $i=0;
        $lala=$this->array_search_recursive('done',0,$tests);
        while(!empty($lala)){
            $this->log("Doing loop ".$i++);
            foreach($tests['tests'] as $testname => $test){
            
                //Update the nodes
                $this->log(print_r($running,true));
                foreach($running as $uid => $j){
                    if(file_exists("logs/log$uid.txt")){
                        $nodes[$j]['Node']['running']--;
                        $this->log($node['name']." running has been decreased");
                        unset($running[$uid]);
                        $this->log(" Removing ".$uid.' => '.$node['name']." from running:");
                        //
                    }
                }
                
                foreach($test as $l=>$need){
                    if($need['done']==0){                        
                        $nodes = Set::sort($nodes, '{n}.Node.running', 'asc');
                        foreach($nodes as $j=>$node){
                            if($need['done']==0){
                                if($node['Node']['running']<$runningLimit){ //If node is not full
                                    if($node['Node']['OS']==$need['OS']){ //If node is the correct OS
                                        if(in_array($need['browser'], $node['Node']['browsers'])){ //If node has the right browser
                                            $uid = rand(0,999999999);
                                            $this->log("Running test $testname on ".$need['OS']." / ".$need['browser']." using resource ".$node['Node']['name']." with uid = $uid");
                                            $running[$uid] = $j;
                                            pclose(popen("start /B php lala.php $uid",'r'));
                                            $nodes[$j]['Node']['running']++; //Update the node
                                            $tests[$testname][$l]['done'] = 1; //Update the need
                                        }else{
                                            $this->log("The need needs browser: ".$need['browser']." but the node only has: ");
                                            $this->log(print_r($node['Node']['browsers'],true));
                                        }
                                    }else{
                                        $this->log("Node with OS: ".$node['Node']['OS']." does not match the needs OS: ".$need['OS']);
                                    }
                                }else{
                                    $this->log("Node ".$node['Node']['name']." is full and running ".$node['Node']['running']." test(s)");
                                }
                            }
                        }
                    }
                }
            }
            sleep(1);
            $lala=$this->array_search_recursive('done',0,$tests);	
        }
         
    }
    
    function log($msg){
        $fp = fopen('logs/thelog.txt','a');
        fwrite($fp, $msg."\n");
        fclose($fp);
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
