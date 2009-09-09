<?php if(!isset($uploaded)): ?>
<div class="testcases form">
<?php echo $form->create('Testcase',array('action'=>"upload/$id", 'enctype' => 'multipart/form-data')); ?>
	<fieldset>
 		<legend><?php __('Upload Testscript');?></legend>
	<?php
		echo $form->file('testscript');
		echo $form->end('Submit');
	?>
	</fieldset>
</div>
<?php endif ?>
