<div class="defectstatuses form">
<?php echo $form->create('Defectstatus');?>
	<fieldset>
 		<legend><?php __('Add Defectstatus');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('imgpath');
		echo $form->input('priority');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Defectstatuses', true), array('action'=>'index'));?></li>
	</ul>
</div>
