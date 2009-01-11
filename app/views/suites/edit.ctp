<div class="suites form">
<?php echo $form->create('Suite');?>
	<fieldset>
 		<legend><?php __('Edit Suite');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('site_id');
		echo $form->input('status');
		echo $form->input('timedate');
		echo $form->input('timetaken');
		echo $form->input('browser_id');
		echo $form->input('operating_system_id');
		echo $form->input('selenium_version');
		echo $form->input('selenium_revision');
		echo $form->input('project_id');
		echo $form->input('analysis');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Suite.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Suite.id'))); ?></li>
		<li><?php echo $html->link(__('List Suites', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Projects', true), array('controller'=> 'projects', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Project', true), array('controller'=> 'projects', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Tests', true), array('controller'=> 'tests', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Test', true), array('controller'=> 'tests', 'action'=>'add')); ?> </li>
	</ul>
</div>
