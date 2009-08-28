<div class="nodes form">
<?php echo $form->create('Node');?>
	<fieldset>
 		<legend><?php __('Edit Node');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('nodepath');
		echo $form->input('operatingsystem_id');
		echo $form->input('description');
		echo $form->input('Browser');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Node.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Node.id'))); ?></li>
	</ul>
</div>
