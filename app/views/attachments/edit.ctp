<div class="attachments form">
<?php echo $form->create('Attachment');?>
	<fieldset>
 		<legend><?php __('Edit Attachment');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('path');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->aclLink(__('Delete', true), array('action'=>'delete', $form->value('Attachment.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Attachment.id'))); ?></li>
		<li><?php echo $html->aclLink(__('List Attachments', true), array('action'=>'index'));?></li>
	</ul>
</div>
