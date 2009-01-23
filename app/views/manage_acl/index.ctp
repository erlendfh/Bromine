<div class="manageacl index">
    <h2><?php __('ACL manager');?></h2>
    <table style='width: 100%;'>
        <tr>
            <td>
                <div id='aros'>
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
                </div>
            </td>
            <td>
                <div id='acos'>
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
                </div>
            </td>
        </tr>
    </table>
</div>
