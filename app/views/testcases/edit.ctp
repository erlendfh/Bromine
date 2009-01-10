<div class="testcases form">
<?php echo $form->create('Testcase');?>
	<fieldset>
 		<legend><?php __('Edit Testcase');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('project_id');
		echo $form->input('description');
		echo $form->input('Requirement');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Testcase.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Testcase.id'))); ?></li>
		<li><?php echo $html->link(__('List Testcases', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Projects', true), array('controller'=> 'projects', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Project', true), array('controller'=> 'projects', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Testcasesteps', true), array('controller'=> 'testcasesteps', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Testcasestep', true), array('controller'=> 'testcasesteps', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Requirements', true), array('controller'=> 'requirements', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Requirement', true), array('controller'=> 'requirements', 'action'=>'add')); ?> </li>
	</ul>
</div>
