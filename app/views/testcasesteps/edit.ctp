<div class="testcasesteps form">
<?php echo $form->create('Testcasestep');?>
	<fieldset>
 		<legend><?php __('Edit Testcasestep');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('orderby');
		echo $form->input('action');
		echo $form->input('reaction');
		echo $form->input('testcase_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Testcasestep.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Testcasestep.id'))); ?></li>
		<li><?php echo $html->link(__('List Testcasesteps', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Testcases', true), array('controller'=> 'testcases', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Testcase', true), array('controller'=> 'testcases', 'action'=>'add')); ?> </li>
	</ul>
</div>
