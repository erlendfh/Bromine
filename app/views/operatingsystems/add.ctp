<div class="operatingsystems form">
<?php echo $form->create('Operatingsystem');?>
	<fieldset>
 		<legend><?php __('Add Operatingsystem');?></legend>
	<?php
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->aclLink(__('List Operatingsystems', true), array('action'=>'index'));?></li>
	</ul>
</div>
