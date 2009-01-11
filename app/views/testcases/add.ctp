<div class="testcases form">
<?php echo $form->create('Testcase');?>
	<fieldset>
 		<legend><?php __('Add Testcase');?></legend>
	<?php
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
		<li><?php echo $html->link(__('List Testcases', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Projects', true), array('controller'=> 'projects', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Project', true), array('controller'=> 'projects', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Testcasesteps', true), array('controller'=> 'testcasesteps', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Testcase Step', true), array('controller'=> 'testcasesteps', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Requirements', true), array('controller'=> 'requirements', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Requirement', true), array('controller'=> 'requirements', 'action'=>'add')); ?> </li>
	</ul>
</div>
