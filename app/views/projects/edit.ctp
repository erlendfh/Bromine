<div class="projects form">
<?php echo $form->create('Project');?>
	<fieldset>
 		<legend><?php __('Edit Project');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('description');
		echo $form->input('outsidedefects');
		echo $form->input('viewdefectsurl');
		echo $form->input('adddefecturl');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Project.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Project.id'))); ?></li>
		<li><?php echo $html->link(__('List Projects', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Requirements', true), array('controller'=> 'requirements', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Requirement', true), array('controller'=> 'requirements', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Sites', true), array('controller'=> 'sites', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Site', true), array('controller'=> 'sites', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Suites', true), array('controller'=> 'suites', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Suite', true), array('controller'=> 'suites', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Testcases', true), array('controller'=> 'testcases', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Testcase', true), array('controller'=> 'testcases', 'action'=>'add')); ?> </li>
	</ul>
</div>
