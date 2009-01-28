<div class="browsers form">
<?php echo $form->create('Browser');?>
	<fieldset>
 		<legend><?php __('Add Browser');?></legend>
	<?php
		echo $form->input('browsername');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->aclLink(__('List Browsers', true), array('action'=>'index'));?></li>
	</ul>
</div>
