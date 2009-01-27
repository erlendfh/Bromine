<div class="requirements form">
<?php echo $form->create('Requirement');?>
	<fieldset>
 		<legend><?php __('Edit Requirement');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('description');
		echo $form->hidden('project_id');
		echo $form->input('nr');
		echo $form->input('priority');
		echo $form->input('Testcase');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>