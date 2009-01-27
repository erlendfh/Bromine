<div class="sites form">
<?php echo $form->create('Site');?>
	<fieldset>
 		<legend><?php __('Add Site');?></legend>
	<?php
		echo $form->input('name',array('value' => 'http://www.'));
		echo $form->hidden('project_id',array('value' => $session->read('project_id')));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
