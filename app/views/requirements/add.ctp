<div class="requirements form">
<?php echo $form->create('Requirement');?>
	<fieldset>
 		<legend><?php __('Add Requirement');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('description');
		echo $form->input('project_id');
		echo $form->input('nr');
		echo $form->input('priority');
		echo $form->input('Testcase');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Requirements', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Projects', true), array('controller'=> 'projects', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Project', true), array('controller'=> 'projects', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Testcases', true), array('controller'=> 'testcases', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Testcase', true), array('controller'=> 'testcases', 'action'=>'add')); ?> </li>
	</ul>
</div>
