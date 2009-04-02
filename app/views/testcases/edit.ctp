<div style='float: right;'>
<?php
    echo $ajax->link( 
            'Cancel', 
            array( 'controller' => 'testcases', 'action' => 'view', $this->data['Testcase']['id']), 
            array( 'update' => 'Main', 'class'=>'testcases view', 'id' => 'cancel'));
?>
</div>
<div class="testcases form">
<?php echo $form->create('Testcase',array('enctype' => 'multipart/form-data')); ?>
	<fieldset>
 		<legend><?php __('Edit Testcase');?></legend>
	<?php
		echo $form->input('name');
		echo $form->hidden('project_id',array('value' => $session->read('project_id')));
		echo $form->input('description');
		echo $form->file('testscript');
		echo $ajax->submit("submit", array("url" => array('controller'=>'testcases','action'=>'edit',$this->data['Testcase']['id']), "update" => "Main", 'enctype' => 'multipart/form-data'));
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
	</tr>
</table>
<div id='sort' style='width: 560px;'>
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
    			<td class='handle' style='height: 50px; width: 20px; float: left; background: url(/img/side.png); border: 1px solid lightgrey; cursor: url("/img/openhand.cur"), move;'></td>
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
            array( 'update' => 'add'));

?>
