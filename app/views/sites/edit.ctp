<div class="sites form">
<?php echo $form->create('Site');?>
	<fieldset>
 		<legend><?php __('Edit Site');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->hidden('project_id',array('value' => $session->read('project_id')));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>