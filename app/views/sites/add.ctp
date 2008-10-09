<div class="sites form">
<?php echo $form->create('Site');?>
	<fieldset>
 		<legend><?php __('Add Site');?></legend>
	<?php
		echo $form->input('site');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Sites', true), array('action'=>'index'));?></li>
	</ul>
</div>
