<?php

class Item extends AppModel {
   
    var $belongsTo = array(
            'User' => array(
                'className' => 'User',
				'foreignKey' => 'user_id',
			),
            'DashboardType' => array(
                'className' => 'DashboardType',
				'foreignKey' => 'dashboard_type_id',
			)
    );	
	
}

?>
