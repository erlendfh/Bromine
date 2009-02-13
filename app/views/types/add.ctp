<div class="types form">
<?php echo $form->create('Type');?>
	<fieldset>
 		<legend><?php __('Add Type');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('command');
		echo $form->input('spacer');
		echo $form->input('extension');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Types', true), array('action'=>'index'));?></li>
	</ul>
</div>
