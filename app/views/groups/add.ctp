<div class="groups form">
<?php echo $form->create('Group');?>
	<fieldset>
 		<legend><?php __('Add Group');?></legend>
	<?php
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->aclLink(__('List Groups', true), array('action'=>'index'));?></li>
		<li><?php echo $html->aclLink(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
	</ul>
</div>
