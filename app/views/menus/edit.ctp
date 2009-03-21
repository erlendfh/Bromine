<div class="menus form">
<?php echo $form->create('Menu');?>
	<fieldset>
 		<legend><?php __('Edit Menu');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('parent_id');
		echo $form->input('name');
		echo $form->input('controller');
		echo $form->input('action');
		echo $form->input('odr');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Menu.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Menu.id'))); ?></li>
		<li><?php echo $html->link(__('List Menus', true), array('action'=>'index'));?></li>
	</ul>
</div>
