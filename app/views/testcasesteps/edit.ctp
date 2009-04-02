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
<?php     echo $ajax->link( 
            'Save step', 
            array( 'controller' => 'testcase', 'action' => 'view', $this->data['Testcase']['id']), 
            array( 'update' => 'Main', 'onclick' => "$('TestcasestepEditForm').request();"));?>
</div>

