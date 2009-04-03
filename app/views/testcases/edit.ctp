<div style='float: right;'>
<?php
    echo $ajax->link( 
            'Back', 
            array( 'controller' => 'testcases', 'action' => 'view', $this->data['Testcase']['id']), 
            array( 'update' => 'Main', 'class'=>'testcases view', 'id' => 'cancel'));
?>
</div>
<div class="testcases form">
<?php echo $form->create('Testcase'); ?>
	<fieldset>
 		<legend><?php __('Edit Testcase');?></legend>
	<?php
		echo $form->input('name');
		echo $form->hidden('project_id',array('value' => $session->read('project_id')));
		echo $form->input('description');
		echo "<div class='input file'>";
        echo "<label>Testscript</label>";
        if(isset($testscript)){
            echo $html->image('tango/32x32/mimetypes/application-x-executable.png');
            echo $html->link('View testscript',array('controller'=>'testcases', 'action'=>'viewscript', $this->data['Testcase']['id']),array('onclick'=>'return Popup.open({url:this.href});'));
    	}else{
    	   echo "No testscript uploaded";
		}
		echo "<br />";
		echo $html->link('Upload new testscript',array('controller'=>'testcases', 'action'=>'upload', $this->data['Testcase']['id']),array('onclick'=>'return Popup.open({url:this.href});'));
		echo "</div>";
		echo $ajax->submit("submit", array("url" => array('controller'=>'testcases','action'=>'edit',$this->data['Testcase']['id']), "update" => "Main"));
		
	?>
	</fieldset>
</div>
<br />
<br />
<table>
	<tr>
        <th style='width: 250px; padding: 5px;'>
            Action
		</th>
        <th style='width: 250px; padding: 5px;'>	
            Reaction
		</th>
		<th style='width: 45px;'>
            Drag
		</th>
		<th>
            Delete
		</th>
	</tr>
</table>
<div id='sort' >
<?php foreach($testcasesteps as $testcasestep): ?>
	<div class='container' id='item_<?php echo $testcasestep['TestcaseStep']['id']; ?>'>
		<table>
    		<tr style='height: 40px; vertical-align: top;'>
                <td style='width: 250px; border: 1px solid lightgrey; padding: 5px;'>
                    <?php echo $testcasestep['TestcaseStep']['action']; ?>
    			</td>
    	        <td style='width: 250px; border: 1px solid lightgrey; padding: 5px;'>	
                    <?php echo $testcasestep['TestcaseStep']['reaction']; ?>
    			</td>
    			<td class='handle' style='height: 50px; width: 40px; float: left; background: url(/img/side.png); border: 1px solid lightgrey; cursor: url("/img/openhand.cur"), move;'>&nbsp;</td>
                <td>
                    <?php 
                        echo $ajax->link( 
                            $html->image('tango/32x32/places/user-trash.png'), 
                            array( 'controller' => 'Testcasesteps', 'action' => 'delete', $testcasestep['TestcaseStep']['id'], $this->data['Testcase']['id']), 
                            array( 'update' => 'Main'),
                            'Are you sure you want to delete this step?', false
                            );
                    ?>
                </td>
    		</tr>
        </table>
	</div>
<?php endforeach; ?>

</div>
<div id='add'>
</div>

<script type='text/javascript'>
Sortable.create("sort", {
    tag: 'div',
    only: 'container',
    handle: 'handle',
    onUpdate: function() {
        new Ajax.Request('/testcasesteps/reorder/'+Sortable.sequence("sort"));
        $('sort').highlight();
    }
});
</script>

<?php
echo $ajax->link( 
            'Add step', 
            array( 'controller' => 'Testcasesteps', 'action' => 'add', $this->data['Testcase']['id']), 
            array( 'update' => 'add', 'onclick'=>'this.toggle();'));

?>
