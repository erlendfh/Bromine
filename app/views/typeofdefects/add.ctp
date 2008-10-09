<div class="typeofdefects form">
<?php echo $form->create('Typeofdefect');?>
	<fieldset>
 		<legend><?php __('Add Typeofdefect');?></legend>
	<?php
		echo $form->input('priority');
		echo $form->input('name');
		echo $form->input('imgpath');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Typeofdefects', true), array('action'=>'index'));?></li>
	</ul>
</div>
