<div class="manageacl index">
    <h1><?php __('ACL manager');?></h1>
    <table>
        <tr>
            <th>Requester browser</th>
            <th>Requester permisssions</th>
        </tr>
        <tr style='vertical-align: top;'>
            <td id='aros' style='vertical-align: top;'>
                <script type="text/javascript">
                    <?php 
                        echo $ajax->remoteFunction( 
                        array( 
                            'url' => array( 'controller' => 'manageAcl', 'action' => 'listAros'), 
                            'update' => 'aros' 
                        ) 
                    ); ?>
                </script>
            </td>
            <td id='permissions' style='vertical-align: top;'>
            </td>
        </tr>
    </table>
</div>
