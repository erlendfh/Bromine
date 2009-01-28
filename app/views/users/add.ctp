<div class="users form">
<?php echo $form->create('User');?>
	<fieldset>
 		<legend><?php __('Add User');?></legend>
	<?php
		echo $form->input('firstname');
		echo $form->input('lastname');
		echo $form->input('name');
		echo $form->input('password');
		echo $form->input('group_id');
		echo $form->input('email');
		echo $form->input('lastLogin');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->aclLink(__('List Users', true), array('action'=>'index'));?></li>
		<li><?php echo $html->aclLink(__('List Defects', true), array('controller'=> 'defects', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Defect', true), array('controller'=> 'defects', 'action'=>'add')); ?> </li>
		<li><?php echo $html->aclLink(__('List Projects', true), array('controller'=> 'projects', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Project', true), array('controller'=> 'projects', 'action'=>'add')); ?> </li>
		<li><?php echo $html->aclLink(__('List Requirements', true), array('controller'=> 'requirements', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Requirement', true), array('controller'=> 'requirements', 'action'=>'add')); ?> </li>
	</ul>
</div>
