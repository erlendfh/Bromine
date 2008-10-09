<div class="coretestsuites form">
<?php echo $form->create('Coretestsuite');?>
	<fieldset>
 		<legend><?php __('Add Coretestsuite');?></legend>
	<?php
		echo $form->input('project_id');
		echo $form->input('testsuite');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Coretestsuites', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Projects', true), array('controller'=> 'projects', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Project', true), array('controller'=> 'projects', 'action'=>'add')); ?> </li>
	</ul>
</div>
