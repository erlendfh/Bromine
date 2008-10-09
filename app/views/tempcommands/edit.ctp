<div class="tempcommands form">
<?php echo $form->create('Tempcommand');?>
	<fieldset>
 		<legend><?php __('Edit Tempcommand');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('uid');
		echo $form->input('action');
		echo $form->input('var1');
		echo $form->input('var2');
		echo $form->input('status');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Tempcommand.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Tempcommand.id'))); ?></li>
		<li><?php echo $html->link(__('List Tempcommands', true), array('action'=>'index'));?></li>
	</ul>
</div>
