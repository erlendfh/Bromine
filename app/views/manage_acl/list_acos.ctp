<h3><?php echo $CurrentAcos['Myaco']['alias']; ?> </h3>
<?php
    foreach($Acos as $Aco){
        echo $ajax->link(
            $Aco['Myaco']['alias'],
            array('controller'=>'manageAcl','action'=>'listAcos',$Aco['Myaco']['id']),
            array( 'update' => 'acos' )
        );
        echo "<br />";
    }
?>
