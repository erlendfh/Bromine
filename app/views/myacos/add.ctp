<div class="myacos form">
<?php echo $form->create('Myaco');?>
	<fieldset>
 		<legend><?php __('Add Myaco');?></legend>
	<?php
		echo $form->input('parent_id');
		echo $form->input('alias');
		echo $form->input('Myaro');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->aclLink(__('List Myacos', true), array('action'=>'index'));?></li>
		<li><?php echo $html->aclLink(__('List Myaros', true), array('controller'=> 'myaros', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Myaro', true), array('controller'=> 'myaros', 'action'=>'add')); ?> </li>
	</ul>
</div>
