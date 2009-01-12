<?php
class Group extends AppModel {

	var $name = 'Group';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'User' => array('className' => 'User',
								'foreignKey' => 'group_id',
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
	
	function afterSave($created){
        App::import('Model','Myaro');
		$this->Myaro = new Myaro();
        
		if($created===true){ //If a new group has been created
            $aroData = array();
    		$aroData['Myaro']['model'] = 'group';
    		$aroData['Myaro']['foreign_key'] = $this->getLastInsertID();
    		$aroData['Myaro']['alias'] = '/'.$this->data['Group']['name'];
            $this->Myaro->save($aroData);
        }else{ //If a group has been updated
            $this->Myaro->updateAll(
                array('alias'=>"'".mysql_real_escape_string("/".$this->data['Group']['name'])."'"),
                array(
                    'model'=>'group',
                    'foreign_key'=>$this->data['Group']['id']
                )
            );
        }

    }
    
    function afterDelete(){
        App::import('Model','Myaro');
		$this->Myaro = new Myaro();

		$this->Myaro->deleteAll(
            array(
                'model' => 'group',
                'foreign_key' => $this->id
            )
        );
    }

}
?>
