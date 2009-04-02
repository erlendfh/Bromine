<div class="testcasesteps form">
<?php echo $form->create('Testcasestep',array('id' => 'TestcasestepAddForm', 'action' => "add/$testcaseid"));?>
	<fieldset>
 		<legend><?php __('Add Testcasestep');?></legend>
	<?php
		echo $form->input('orderby',array('value' => $orderby));
		echo $form->input('action');
		echo $form->input('reaction');
		echo $form->hidden('testcase_id',array('value' => $testcaseid));
	?>
	</fieldset>
<?php     echo $ajax->link( 
            'Save step', 
            array( 'controller' => 'testcases', 'action' => 'edit', $testcaseid), 
            array( 'update' => 'Main', 'onclick' => "$('TestcasestepAddForm').request();"));?>
</div>

