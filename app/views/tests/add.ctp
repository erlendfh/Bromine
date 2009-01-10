<div class="tests form">
<?php echo $form->create('Test');?>
	<fieldset>
 		<legend><?php __('Add Test');?></legend>
	<?php
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
		<li><?php echo $html->link(__('List Tests', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Suites', true), array('controller'=> 'suites', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Suite', true), array('controller'=> 'suites', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Commands', true), array('controller'=> 'commands', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Command', true), array('controller'=> 'commands', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Seleniumservervars', true), array('controller'=> 'seleniumservervars', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Seleniumservervar', true), array('controller'=> 'seleniumservervars', 'action'=>'add')); ?> </li>
	</ul>
</div>
