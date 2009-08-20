<div class="types form">
<?php echo $form->create('Type');?>
	<fieldset>
 		<legend><?php __('Edit Type');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('command');
		echo $form->input('spacer');
		echo $form->input('extension');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Type.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Type.id'))); ?></li>
	</ul>
</div>
