<?php
class TestcasesController extends AppController {

	var $name = 'Testcases';
	var $helpers = array('Html', 'Form', 'Table', 'Time');
	var $components = array('Script');

	function index() {
		$this->Testcase->recursive = 0;
		$this->set('testcases', $this->paginate(null, array('Project.id' => $this->Session->read('project_id'))));
	}
	
	function lilist($search=null) {

        $conditions = array('Project.id' => $this->Session->read('project_id'));
        if(!empty($this->data['tcsearch'])){
            $conditions['Testcase.name  LIKE'] = $this->data['tcsearch']."%";
        }
		$this->Testcase->recursive = 0;
		$this->set('testcases', $this->Testcase->find('all',array('conditions'=>$conditions,'order'=>'Testcase.name asc')));
	}


	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Testcase.', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->set('testcase', $this->Testcase->read(null, $id));
		$testcasesteps = $this->Testcase->TestcaseStep->findAll(array('testcase_id' => $id),null,array('order by' => 'TestcaseStep.orderby'));
    	$this->set('testcasesteps',$testcasesteps);
    	
    	if($script=$this->Script->getTestScript($id)){
    	   $this->set('testscript',$script);
    	}
	}
	
	function testlabview($id = null, $requirement_id) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid Testcase.', true));
			$this->redirect(array('action'=>'index'));
		}
		
		$this->set('testcase', $this->Testcase->read(null, $id));
		$testcasesteps = $this->Testcase->TestcaseStep->findAll(array('testcase_id' => $id),null,array('order by' => 'TestcaseStep.orderby'));
    	$this->set('testcasesteps',$testcasesteps);

        $this->Testcase->Requirement->Behaviors->attach('Containable');
		$requirement = $this->Testcase->Requirement->find('first', array(
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
        foreach ($requirement['Combination'] as &$combination){
            $combination['Result'] = $this->Testcase->Test->getLastInCombination($id, $combination['Operatingsystem']['id'], $combination['Browser']['id']);
        }
        if(!$this->Script->getTestScript($id)) $this->set('noScript', "No test script uploaded.");
        $this->set('nodes', $nodes);
        $this->set('requirement', $requirement);
        $this->set('onlineNodes', $onlineNodes);
        $this->set('combinations',$requirement['Combination']);
	}
	
	function viewscript($id = null) {
        $this->layout = 'green_blank';
		if (!$id) {
			$this->Session->setFlash(__('Invalid Testcase.', true));
			$this->redirect(array('action'=>'index'));
		}else{
            $this->set('testscript',$this->Script->getTestScript($id));
        }
	}

	function add() {
		if (!empty($this->data)) {
			$this->Testcase->create();
			if ($this->Testcase->save($this->data)) {
				$this->Session->setFlash(__('The Testcase has been saved', true));
				$this->redirect(
    				array(
    				    'controller'=>'requirements#/testcases',
    				    'action' => 'edit',
    				    $this->Testcase->id
                    )
                );
			} else {
				$this->Session->setFlash(__('The Testcase could not be saved. Please, try again.', true));
			}
		}
		$projects = $this->Testcase->Project->find('list');
	}

	function edit($id = null) {
        $this->Testcase->recursive = 0;
		if (!$id && empty($this->data)) {
			$this->Session->setFlash('Invalid Testcase', true, array('class'=>'error'));
			$this->redirect(array('action'=>'index'));
		}
		if (!empty($this->data)){
            if ($this->Testcase->save($this->data)) {
				$this->Session->setFlash(__('The Testcase has been saved', true));
			} else {
				$this->Session->setFlash('The Testcase could not be saved. Please, try again.', true, array('class'=>'error'));
			}
		}
        if($id){
    		$this->data = $this->Testcase->read(null, $id);
    		$testcasesteps = $this->Testcase->TestcaseStep->findAll(array('testcase_id' => $id),null,array('order by' => 'TestcaseStep.orderby'));
    		$this->set('testcasesteps',$testcasesteps);
        	if($script=$this->Script->getTestScript($id)){
        	   $this->set('testscript',$script);
        	}
		}
	}
	
	function upload($id = null){
	   
        $this->layout = 'green_blank';
        $files = $this->Script->getTestScript($id, true);
        if(!empty($files)) {
            $this->Session->setFlash("Uploading a new file will remove the old one.", true, array('class' => 'warning'));
        }
        if($id){
            $this->set('id',$id);
            if($this->data['Testcase']['testscript']['name']!=''){
                $ext = end(explode('.', $this->data['Testcase']['testscript']['name']));
                $dir = WWW_ROOT.'testscripts'.DS.$this->Session->read('project_name').DS.$ext;                
                if(!file_exists($dir)){
                    mkdir($dir, 0777, true);
                }
                $uploadfile = $dir.DS.$id.".$ext";
                App::import('Model','Type');
                $this->Type = new Type();
                $extList = $this->Type->find('list', array('fields' => array('Type.extension')));
                if(in_array($ext, $extList)){                   
                    if(!empty($files)){
                        foreach($files as $file){
                            if(!unlink($file)){
                                $this->Session->setFlash('Could not delete file: '.$file.' please delete manually before trying to upload file again.', true, array('class' => 'error'));
                                exit();
                            }
                        }
                    }
                    if (move_uploaded_file($this->data['Testcase']['testscript']['tmp_name'], $uploadfile)) {
                        $this->Session->setFlash(__('The Testscript has been uploaded',true));
                        $this->set('uploaded',true);
        			}else{
                        $this->Session->setFlash('Script not uploaded. The file could not be uploaded. Check folder permissions', true, array('class' => 'error'));
                    }
                }else{
                    $this->Session->setFlash('Script not uploaded. Filetype not accepted. The accepted filetypes are '.implode(', ', $extList), true, array('class' => 'error'));
                }
    		}
    	}else{
            $this->Session->setFlash(__('No testcase id provided',true));
        }
    }

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for Testcase', true));
			$this->redirect(array('controller'=>'requirements','action'=>'index'));
		}
		if ($this->Testcase->del($id)) {
			$this->Session->setFlash(__('Testcase deleted', true));
			$this->redirect(array('controller'=>'requirements','action'=>'index'));
		}
	}
	
	/*
	function addToJira($test_id){
	   $this->layout = 'green_blank';	
        $test = $this->Testcase->Test->find('first',array(
            'conditions'=>array(
                'Test.id'=> $test_id
            )));
            
        $browserTxt = $test['Browser']['name'].'('.$test['Browser']['path'].')';
        $operationSystemTxt = $test['Operatingsystem']['name'];
        $nodeTxt = $test['Seleniumserver']['nodepath'];
        $testTxt = $test['Test']['name'];
        $timeTxt = $test['Test']['timestamp'];
        $siteTxt = $test['Command'][0]['var2'];
        $errors = '';
        foreach ($test['Command'] as $command){
            if ($command['status'] == 'failed'){
                $errors .= $command['action']."('".$command['var1']."','".$command['var2']."','".$command['status']."'), ";
            }
        }
        
        $description = "The test '$testTxt' ran on $nodeTxt at $timeTxt and caused the following errors: $errors";
        chdir('jiracli');
        $exe = 'jira -v --action createIssue --assignee "someones ID in jira" --project "someproject" --summary "Automatic bug report from Bromine" --type bug --environment "'.$browserTxt.' on '. $operationSystemTxt .'" --priority minor --autoVersion --description "'.$description.'"';
        exec($exe, $output, $return_var);
        $txt = '';
        foreach ($output as $o){
            $txt .= $o . "<br />"; 
        }
        $this->set('output',$txt);
    }
    */
}
?>
