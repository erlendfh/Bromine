<div class="types form">
<?php echo $form->create('Type');?>
	<fieldset>
 		<legend><?php __('Add Type');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('command');
		echo $form->input('spacer');
		echo $form->input('extension');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>