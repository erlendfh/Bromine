<div class="defects form">
<?php echo $form->create('Defect');?>
	<fieldset>
 		<legend><?php __('Edit Defect');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('user_id');
		echo $form->input('description');
		echo $form->input('type');
		echo $form->input('status');
		echo $form->input('project_id');
		echo $form->input('test_id');
		echo $form->input('updatedby');
		echo $form->input('name');
		echo $form->input('priority');
		echo $form->input('site_id');
		echo $form->input('Attachment');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Defect.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Defect.id'))); ?></li>
		<li><?php echo $html->link(__('List Defects', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Projects', true), array('controller'=> 'projects', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Project', true), array('controller'=> 'projects', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Tests', true), array('controller'=> 'tests', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Test', true), array('controller'=> 'tests', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Sites', true), array('controller'=> 'sites', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Site', true), array('controller'=> 'sites', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Attachments', true), array('controller'=> 'attachments', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Attachment', true), array('controller'=> 'attachments', 'action'=>'add')); ?> </li>
	</ul>
</div>
