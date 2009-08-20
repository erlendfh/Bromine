<div class="operatingsystems form">
<?php echo $form->create('Operatingsystem');?>
	<fieldset>
 		<legend><?php __('Edit Operatingsystem');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->aclLink(__('Delete', true), array('action'=>'delete', $form->value('Operatingsystem.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Operatingsystem.id'))); ?></li>
	</ul>
</div>
