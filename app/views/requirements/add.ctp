<div class="requirements form">
<?php echo $form->create('Requirement');?>
	<fieldset>
 		<legend><?php __('Add Requirement');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('description');
		echo $form->hidden('project_id',array('value' => $session->read('project_id')));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
