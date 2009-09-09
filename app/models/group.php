<?php
class Group extends AppModel {

	var $name = 'Group';

	var $hasOne = array(
        'Myaro' => array(
            'foreignKey' => 'foreign_key',
            'className'    => 'Myaro',
            'conditions'   => array('Myaro.model' => 'group'),
            'dependent'    => true
        )
    );
    
	var $hasMany = array(
    	'User' => array('className' => 'User',
    						'foreignKey' => 'group_id',
    						'dependent' => true,
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
		$this->Myaro->recursive = 0;
        
		if($created===true){ //If a new group has been created
            $aroData = array();
    		$aroData['Myaro']['model'] = 'group';
    		$aroData['Myaro']['foreign_key'] = $this->getLastInsertID();
    		$aroData['Myaro']['alias'] = '/'.$this->data['Group']['name'];
            $this->Myaro->save($aroData);
        }else{ //If a group has been updated.
            $this->Myaro->updateAll( //Update the group Aro
                array('alias'=>"'".mysql_real_escape_string("/".$this->data['Group']['name'])."'"),
                array(
                    'model'=>'group',
                    'foreign_key'=>$this->data['Group']['id']
                )
            );
            $this->data=am($this->data, $this->Myaro->find(array('foreign_key'=>$this->data['Group']['id'],'model'=>'group')));
            $affectedUserAros = $this->Myaro->find('all',array('conditions'=>array('parent_id'=>$this->data['Myaro']['id'],'model'=>'user')));
            foreach($affectedUserAros as $affectedUserAro){ //Update the user Aros that are children of the updated group
                $alias = split('/',$affectedUserAro['Myaro']['alias']);
                $alias = '/'.$this->data['Group']['name'].'/'.$alias[2];
                $this->Myaro->updateAll(
                    array('alias'=>"'".mysql_real_escape_string($alias)."'"),
                    array(
                        'id'=>$affectedUserAro['Myaro']['id']
                    )
                );
            }
        }

    }

}
?>
