<div class="tempcommands form">
<?php echo $form->create('Tempcommand');?>
	<fieldset>
 		<legend><?php __('Add Tempcommand');?></legend>
	<?php
		echo $form->input('uid');
		echo $form->input('action');
		echo $form->input('var1');
		echo $form->input('var2');
		echo $form->input('status');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->aclLink(__('List Tempcommands', true), array('action'=>'index'));?></li>
	</ul>
</div>
