<div class="browsers form">
<?php echo $form->create('Browser');?>
	<fieldset>
 		<legend><?php __('Add Browser');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('path');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Browsers', true), array('action'=>'index'));?></li>
	</ul>
</div>
