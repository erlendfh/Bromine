<?php
class Project extends AppModel {

	var $name = 'Project';
	
	function beforeFind2($queryData){
        $queryData['conditions']['Project.id']=$_SESSION['project_id']; //Un-cakeli
        //pr($queryData);
        return $queryData;
    }

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	
	var $hasMany = array(
			'Requirement' => array('className' => 'Requirement',
								'foreignKey' => 'project_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			),
			'Suite' => array('className' => 'Suite',
								'foreignKey' => 'project_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			),
			'Testcase' => array('className' => 'Testcase',
								'foreignKey' => 'project_id',
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
        'Myaco' => array(
            'foreignKey' => 'foreign_key',
            'className'    => 'Myaco',
            'conditions'   => array('Myaco.model' => 'project'),
            'dependent'    => true
        )
    );
	
	function afterSave($created){
        App::import('Model','Myaco');
		$this->Myaco = new Myaco();
		if($created===true){ //Todo: create acos for /everything/projects/edit(delete)/$project_id
    		$acoData = array();
            $acoData['Myaco']['parent_id'] = 1;
            $acoData['Myaco']['foreign_key'] = $this->getLastInsertID();
            $acoData['Myaco']['model'] = 'project';
    		$acoData['Myaco']['alias'] = '/everything/'.$this->data['Project']['name'];
            $this->Myaco->save($acoData);
        }else{ //Todo: update acos for /everything/projects/edit(delete)/$project_id
            $this->Myaco->updateAll( //Update the group Aro
                array('alias'=>"'".mysql_real_escape_string('/everything/'.$this->data['Project']['name'])."'"),
                array(
                    'model'=>'project',
                    'foreign_key'=>$this->data['Project']['id']
                )
            );
        }
    }

}
?>
