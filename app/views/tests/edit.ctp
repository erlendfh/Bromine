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
		echo $form->input('browser_id');
		echo $form->input('operatingsystem_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Test.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Test.id'))); ?></li>
		<li><?php echo $html->link(__('List Tests', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Suites', true), array('controller'=> 'suites', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Suite', true), array('controller'=> 'suites', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Browsers', true), array('controller'=> 'browsers', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Browser', true), array('controller'=> 'browsers', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Operatingsystems', true), array('controller'=> 'operatingsystems', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Operatingsystem', true), array('controller'=> 'operatingsystems', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Commands', true), array('controller'=> 'commands', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Command', true), array('controller'=> 'commands', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Seleniumservers', true), array('controller'=> 'seleniumservers', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Seleniumserver', true), array('controller'=> 'seleniumservers', 'action'=>'add')); ?> </li>
	</ul>
</div>
