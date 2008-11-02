<div class="projects form">
<?php echo $form->create('Project');?>
	<fieldset>
 		<legend><?php __('Edit Project');?></legend>
	<?php
	   
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('description');
		echo $form->input('User');
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
		<li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Coresettings', true), array('controller'=> 'coresettings', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Coresetting', true), array('controller'=> 'coresettings', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Coretestsuites', true), array('controller'=> 'coretestsuites', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Coretestsuite', true), array('controller'=> 'coretestsuites', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Defects', true), array('controller'=> 'defects', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Defect', true), array('controller'=> 'defects', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Requirements', true), array('controller'=> 'requirements', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Requirement', true), array('controller'=> 'requirements', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Suites', true), array('controller'=> 'suites', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Suite', true), array('controller'=> 'suites', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Testcases', true), array('controller'=> 'testcases', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Testcase', true), array('controller'=> 'testcases', 'action'=>'add')); ?> </li>
	</ul>
</div>
