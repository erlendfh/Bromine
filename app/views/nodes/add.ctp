<div class="nodes form">
<?php echo $form->create('Node');?>
	<fieldset>
 		<legend><?php __('Add Node');?></legend>
	<?php
		echo $form->input('nodepath');
		echo $form->input('operatingsystem_id');
		echo $form->input('description');
		echo $form->input('Browser');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>