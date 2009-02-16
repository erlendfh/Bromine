<div class="seleniumservervars form">
<?php echo $form->create('Seleniumservervar');?>
	<fieldset>
 		<legend><?php __('Add Seleniumservervar');?></legend>
	<?php
		echo $form->input('session');
		echo $form->input('nodepath');
		echo $form->input('test_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->aclLink(__('List Seleniumservervars', true), array('action'=>'index'));?></li>
	</ul>
</div>
