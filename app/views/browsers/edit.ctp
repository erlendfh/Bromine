<div class="browsers form">
<?php echo $form->create('Browser');?>
	<fieldset>
 		<legend><?php __('Edit Browser');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('browsername');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->aclLink(__('Delete', true), array('action'=>'delete', $form->value('Browser.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Browser.id'))); ?></li>
		<li><?php echo $html->aclLink(__('List Browsers', true), array('action'=>'index'));?></li>
	</ul>
</div>
