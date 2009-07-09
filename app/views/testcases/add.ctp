<div class="testcases form">
<?php echo $form->create('Testcase');?>
	<fieldset>
 		<legend><?php __('Add Testcase');?></legend>
	<?php
		echo $form->input('name');
		echo $form->hidden('project_id',array('value' => $session->read('project_id')));
		echo $form->input('description');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
