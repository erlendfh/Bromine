<div class="sites form">
<?php echo $form->create('Site');?>
	<fieldset>
 		<legend><?php __('Edit Site');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('project_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Site.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Site.id'))); ?></li>
		<li><?php echo $html->link(__('List Sites', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Projects', true), array('controller'=> 'projects', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Project', true), array('controller'=> 'projects', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Suites', true), array('controller'=> 'suites', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Suite', true), array('controller'=> 'suites', 'action'=>'add')); ?> </li>
	</ul>
</div>
