<div class="myaros form">
<?php echo $form->create('Myaro');?>
	<fieldset>
 		<legend><?php __('Edit Myaro');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('parent_id');
		echo $form->input('alias');
		echo $form->input('Myaco');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->aclLink(__('Delete', true), array('action'=>'delete', $form->value('Myaro.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Myaro.id'))); ?></li>
		<li><?php echo $html->aclLink(__('List Myaros', true), array('action'=>'index'));?></li>
		<li><?php echo $html->aclLink(__('List Myacos', true), array('controller'=> 'myacos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Myaco', true), array('controller'=> 'myacos', 'action'=>'add')); ?> </li>
	</ul>
</div>
