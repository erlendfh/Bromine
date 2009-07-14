<div class="projects form">
<?php echo $form->create('Project');?>
	<fieldset>
 		<legend><?php __('Add Project');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('description');
		echo $form->input('outsidedefects');
		echo $form->input('viewdefectsurl');
		echo $form->input('adddefecturl');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>