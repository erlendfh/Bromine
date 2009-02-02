<h3><?php echo $CurrentAcos['Myaco']['alias']; ?> </h3>
<?php
    if(!empty($CurrentAcos)){
        echo $ajax->link(
                '..',
                array('controller'=>'manageAcl','action'=>'listAcos',$CurrentAcos['Myaco']['parent_id']),
                array( 'update' => 'acos' )
            );
        echo "<br />";
    }
    foreach($Acos as $Aco){
        echo $ajax->link(
            end(split('/',$Aco['Myaco']['alias'])),
            array('controller'=>'manageAcl','action'=>'listAcos',$Aco['Myaco']['id']),
            array( 'update' => 'acos' )
        );
        echo "<br />";
    }
?>
