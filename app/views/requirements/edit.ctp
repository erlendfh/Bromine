<div style='float: right;'>
<?php
    echo $ajax->link( 
            'Back', 
            array( 'controller' => 'requirements', 'action' => 'view', $requirement['Requirement']['id']), 
            array( 'update' => 'Main', 'class'=>'requirements view', 'id' => 'cancel'));
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
