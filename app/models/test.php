<?php
class Test extends AppModel {
    var $site_id;
    
    function getLastInCombination($testcase_id, $os_id, $browser_id){
        $opts = array(
            'conditions' => array(
                'Testcase.id' => $testcase_id,
                'Suite.site_id' => $_SESSION['site_id'], //Not very cakely
                'Operatingsystem.id' => $os_id,
                'Browser.id' => $browser_id
            ),
            'order' => 'Test.id DESC'
        );
        $test = $this->find('first', $opts);
        if(!empty($test)){
            if($test['Test']['status']=='' && !empty($test['Command'])){ //If no status set for the test, find one by looking at commands
                $status = 'failed'; //Assume test failed and try to prove otherwise
                $opts = array(
                    'conditions' => array(
                        'Test.id' => $test['Test']['id'],
                        'Command.status' => 'failed'
                    )
                ); 
                if($this->Command->find('count',$opts)==0){ //If no failed commands, set status to passed
                    $status = 'passed';
                }
                $test['Test']['status'] = $status; //Update status
            }
        }
        return $test;
    }
    
    function getStatus($testcase_id, $os_id, $browser_id){
        $test = $this->getLastInCombination($testcase_id, $os_id, $browser_id);
        if(!empty($test)){
            return $test['Test']['status'];
        }else{
            return 'notdone';
        }
    }
    
	var $name = 'Test';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
            'Testcase' => array('className' => 'Testcase',
								'foreignKey' => 'testcase_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Browser' => array('className' => 'Browser',
								'foreignKey' => 'browser_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Operatingsystem' => array('className' => 'Operatingsystem',
								'foreignKey' => 'operatingsystem_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Suite' => array('className' => 'Suite',
								'foreignKey' => 'suite_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
			
	);

	var $hasMany = array(
			'Command' => array('className' => 'Command',
								'foreignKey' => 'test_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			)
	);
	
	var $hasOne = array(
        'Seleniumserver' => array('className' => 'Seleniumserver',
								'foreignKey' => 'test_id',
								'conditions' => '',
								'fields' => '',
								'order' => '',
			)
    );

}
?>
