<div class="configs form">
<?php echo $form->create('Config');?>
	<fieldset>
 		<legend><?php __('Edit Config');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('var');
		echo $form->input('value');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->aclLink(__('Delete', true), array('action'=>'delete', $form->value('Config.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Config.id'))); ?></li>
		<li><?php echo $html->aclLink(__('List Configs', true), array('action'=>'index'));?></li>
	</ul>
</div>
