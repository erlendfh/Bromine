<div class="typeofdefects form">
<?php echo $form->create('Typeofdefect');?>
	<fieldset>
 		<legend><?php __('Edit Typeofdefect');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('priority');
		echo $form->input('name');
		echo $form->input('imgpath');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->aclLink(__('Delete', true), array('action'=>'delete', $form->value('Typeofdefect.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Typeofdefect.id'))); ?></li>
		<li><?php echo $html->aclLink(__('List Typeofdefects', true), array('action'=>'index'));?></li>
	</ul>
</div>
