<h3><?php echo $CurrentAros['Myaro']['alias']; ?> </h3>
<?php
    if(!empty($CurrentAros)){
        echo $ajax->link(
                '..',
                array('controller'=>'manageAcl','action'=>'listAros',$CurrentAros['Myaro']['parent_id']),
                array( 'update' => 'aros' )
            );
        echo "<br />";
    }
    foreach($Aros as $Aro){
        echo $ajax->link(
            end(split('/',$Aro['Myaro']['alias'])),
            array('controller'=>'manageAcl','action'=>'listAros',$Aro['Myaro']['id']),
            array( 'update' => 'aros' )
        );
        echo "<br />";
    }
?>
