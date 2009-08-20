<div class="users form">
<?php echo $form->create('User');?>
	<fieldset>
 		<legend><?php __('Add User');?></legend>
	<?php
		echo $form->input('firstname');
		echo $form->input('lastname');
		echo $form->input('name');
		echo $form->input('password');
		echo $form->input('group_id');
		echo $form->input('email');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
