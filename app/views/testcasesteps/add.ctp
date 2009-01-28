<div class="testcasesteps form">
<?php echo $form->create('Testcasestep',array('action' => "add/$testcaseid"));?>
	<fieldset>
 		<legend><?php __('Add Testcasestep');?></legend>
	<?php
		echo $form->input('orderby',array('value' => $orderby));
		echo $form->input('action');
		echo $form->input('reaction');
		echo $form->hidden('testcase_id',array('value' => $testcaseid));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->aclLink(__('List Testcasesteps', true), array('action'=>'index'));?></li>
		<li><?php echo $html->aclLink(__('List Testcases', true), array('controller'=> 'testcases', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Testcase', true), array('controller'=> 'testcases', 'action'=>'add')); ?> </li>
	</ul>
</div>
