<div class="tests form">
<?php echo $form->create('Test');?>
	<fieldset>
 		<legend><?php __('Edit Test');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('status');
		echo $form->input('name');
		echo $form->input('suite_id');
		echo $form->input('help');
		echo $form->input('manstatus');
		echo $form->input('author');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->aclLink(__('Delete', true), array('action'=>'delete', $form->value('Test.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Test.id'))); ?></li>
		<li><?php echo $html->aclLink(__('List Tests', true), array('action'=>'index'));?></li>
		<li><?php echo $html->aclLink(__('List Suites', true), array('controller'=> 'suites', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Suite', true), array('controller'=> 'suites', 'action'=>'add')); ?> </li>
		<li><?php echo $html->aclLink(__('List Commands', true), array('controller'=> 'commands', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Command', true), array('controller'=> 'commands', 'action'=>'add')); ?> </li>
		<li><?php echo $html->aclLink(__('List Defects', true), array('controller'=> 'defects', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Defect', true), array('controller'=> 'defects', 'action'=>'add')); ?> </li>
	</ul>
</div>
