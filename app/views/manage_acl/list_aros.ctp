<h3><?php echo $CurrentAros['Myaro']['alias']; ?> </h3>
<?php
    foreach($Aros as $Aro){
        echo $ajax->link(
            $Aro['Myaro']['alias'],
            array('controller'=>'manageAcl','action'=>'listAros',$Aro['Myaro']['id']),
            array( 'update' => 'aros' )
        );
        echo "<br />";
    }
?>
