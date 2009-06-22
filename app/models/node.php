<?php
class Node extends AppModel {

    function checkJavaServer($nodepath, $timeout=0.05){
        $nodepath = explode(':',$nodepath);
        $host = $nodepath[0];
        $port = $nodepath[1];
        
        $fp = @fsockopen($host, $port, $errno, $errstr, $timeout);
        if ($fp) {
            fclose($fp);
            flush();
            return true;
        } else {
            flush();
            return false;
        }
    }
    
	var $name = 'Node';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Operatingsystem' => array('className' => 'Operatingsystem',
								'foreignKey' => 'operatingsystem_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

	var $hasAndBelongsToMany = array(
			'Browser' => array('className' => 'Browser',
						'joinTable' => 'browsers_nodes',
						'foreignKey' => 'node_id',
						'associationForeignKey' => 'browser_id',
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

}
?>
