<div class="commands form">
<?php echo $form->create('Command');?>
	<fieldset>
 		<legend><?php __('Edit Command');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('status');
		echo $form->input('action');
		echo $form->input('var1');
		echo $form->input('var2');
		echo $form->input('test_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Command.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Command.id'))); ?></li>
		<li><?php echo $html->link(__('List Commands', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Tests', true), array('controller'=> 'tests', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Test', true), array('controller'=> 'tests', 'action'=>'add')); ?> </li>
	</ul>
</div>
