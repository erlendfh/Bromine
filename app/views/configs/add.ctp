<div class="configs form">
<?php echo $form->create('Config');?>
	<fieldset>
 		<legend><?php __('Add Config');?></legend>
	<?php
		echo $form->input('var');
		echo $form->input('value');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Configs', true), array('action'=>'index'));?></li>
	</ul>
</div>
