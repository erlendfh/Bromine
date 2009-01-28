<div class="defectstatuses form">
<?php echo $form->create('Defectstatus');?>
	<fieldset>
 		<legend><?php __('Edit Defectstatus');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('imgpath');
		echo $form->input('priority');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->aclLink(__('Delete', true), array('action'=>'delete', $form->value('Defectstatus.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Defectstatus.id'))); ?></li>
		<li><?php echo $html->aclLink(__('List Defectstatuses', true), array('action'=>'index'));?></li>
	</ul>
</div>
