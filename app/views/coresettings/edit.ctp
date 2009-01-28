<div class="coresettings form">
<?php echo $form->create('Coresetting');?>
	<fieldset>
 		<legend><?php __('Edit Coresetting');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('site_id');
		echo $form->input('project_id');
		echo $form->input('location');
		echo $form->input('testpath');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->aclLink(__('Delete', true), array('action'=>'delete', $form->value('Coresetting.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Coresetting.id'))); ?></li>
		<li><?php echo $html->aclLink(__('List Coresettings', true), array('action'=>'index'));?></li>
		<li><?php echo $html->aclLink(__('List Sites', true), array('controller'=> 'sites', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Site', true), array('controller'=> 'sites', 'action'=>'add')); ?> </li>
		<li><?php echo $html->aclLink(__('List Projects', true), array('controller'=> 'projects', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Project', true), array('controller'=> 'projects', 'action'=>'add')); ?> </li>
	</ul>
</div>
