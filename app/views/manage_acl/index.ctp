<div class="manageacl index">
    <h2><?php __('ACL manager');?></h2>
    <table style='width: 100%;'>
        <tr>
            <th>Requesters</th>
            <th>Resources</th>
        </tr>
        <tr>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>
                <div id='aros'>
                    <script type="text/javascript">
                        <?php 
                            echo $ajax->remoteFunction( 
                            array( 
                                'url' => array( 'controller' => 'manageAcl', 'action' => 'listAros'), 
                                'update' => 'aros' 
                            ) 
                        ); ?>
                    </script>
                </div>
            </td>
            <td>
                <div id='acos'>
                    <script type="text/javascript">
                        <?php echo $ajax->remoteFunction( 
                            array( 
                                'url' => array( 'controller' => 'manageAcl', 'action' => 'listAcos'), 
                                'update' => 'acos' 
                            ) 
                        ); ?>
                    </script>
                </div>
            </td>
        </tr>
    </table>
</div>
