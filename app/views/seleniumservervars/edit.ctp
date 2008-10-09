<div class="seleniumservervars form">
<?php echo $form->create('Seleniumservervar');?>
	<fieldset>
 		<legend><?php __('Edit Seleniumservervar');?></legend>
	<?php
		echo $form->input('session');
		echo $form->input('nodepath');
		echo $form->input('uid');
		echo $form->input('test_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Seleniumservervar.uid')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Seleniumservervar.uid'))); ?></li>
		<li><?php echo $html->link(__('List Seleniumservervars', true), array('action'=>'index'));?></li>
	</ul>
</div>
