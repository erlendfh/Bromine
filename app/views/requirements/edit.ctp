<div style='float: right;'>
<?php
    echo $ajax->link( 
            $html->image('tango/32x32/actions/go-previous.png').'<br />Back', 
            array( 'controller' => 'requirements', 'action' => 'view', $requirement['Requirement']['id']), 
            array( 'update' => 'Main', 'class'=>'requirements view', 'id' => 'cancel'), null, false);
    echo "<br />";
    echo "<br />";
    echo $html->link( 
            $html->image('tango/32x32/places/user-trash.png').'<br />Delete', 
            array( 'controller' => 'requirements', 'action' => 'delete', $requirement['Requirement']['id']), 
            array( 'class'=>'requirements delete', 'id' => 'delete'),
            'Are you sure you want to delete this requirement?', false
            );
?>
</div>
<div class="requirements form">
<?php echo $form->create('Requirement');?>
	<fieldset>
 		<legend><?php __('Edit Requirement');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('description');
		echo $form->hidden('project_id');
	?>
	</fieldset>
<?php echo $ajax->submit("submit", array("url" => array('controller'=>'Requirements','action'=>'edit',$requirement['Requirement']['id']), "update" => "Main")); ?>
<div class='requirements combinations'>
<?php
    echo $table->createTable($browsers, $operatingsystems, $combinations, true, $requirement['Requirement']['id'])
?>
</div>
</div>
