<div class="myacos form">
<?php echo $form->create('Myaco');?>
	<fieldset>
 		<legend><?php __('Edit Myaco');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('parent_id');
		echo $form->input('alias');
		echo $form->input('Myaro');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Myaco.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Myaco.id'))); ?></li>
		<li><?php echo $html->link(__('List Myacos', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Myaros', true), array('controller'=> 'myaros', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Myaro', true), array('controller'=> 'myaros', 'action'=>'add')); ?> </li>
	</ul>
</div>
