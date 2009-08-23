<?php
class User extends AppModel {

	var $name = 'User';
	var $validate = array(
        'name' => array('notempty')
    );

    var $belongsTo = array(
		'Group' => array('className' => 'Group',
							'foreignKey' => 'group_id',
							'conditions' => '',
							'fields' => '',
							'order' => ''
		)
	);
	
	var $hasAndBelongsToMany = array(
			'Project' => array('className' => 'Project',
						'joinTable' => 'projects_users',
						'foreignKey' => 'user_id',
						'associationForeignKey' => 'project_id',
						'unique' => true,
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
			)
	);
	
	var $hasOne = array(
        'Myaro' => array(
            'foreignKey' => 'foreign_key',
            'className'    => 'Myaro',
            'conditions'   => array('Myaro.model' => 'user'),
            'dependent'    => true
        )
    );  
	
	function afterSave($created){
        App::import('Model','Myaro');
		$this->Myaro = new Myaro();
		
		$this->Myaro->recursive = 0;
        $this->data=am($this->data, $this->Myaro->find(array('foreign_key'=>$this->data['User']['group_id'],'model'=>'group')));
        //pr($this->data);
		if($created===true){ //If a new user has been created
            $aroData = array();
    		$aroData['Myaro']['model'] = 'user';
    		$aroData['Myaro']['foreign_key'] = $this->getLastInsertID();
    		$aroData['Myaro']['parent_id'] = $this->data['Myaro']['id'];
    		$aroData['Myaro']['alias'] = $this->data['Myaro']['alias'].'/'.$this->data['User']['name'];
            $this->Myaro->save($aroData);
        }else{ //If a user has been updated
            $this->Myaro->updateAll(
                array(
                    'alias'=>"'".mysql_real_escape_string($this->data['Myaro']['alias']."/".$this->data['User']['name'])."'",
                    'parent_id' => $this->data['Myaro']['id']
                ),
                array(
                    'model'=>'user',
                    'foreign_key'=>$this->data['User']['id']
                )
            );
        }

    }
    
}
?>
