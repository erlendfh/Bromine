<div class="testcasesteps form">
<?php echo $form->create('Testcasestep');?>
	<fieldset>
 		<legend><?php __('Add Testcasestep');?></legend>
	<?php
		//echo $form->input('orderby',array('value' => $orderby));
		echo $form->input('action');
		echo $form->input('reaction');
		echo $form->hidden('testcase_id',array('value' => $testcaseid));
        echo $ajax->submit("submit", array("url" => array('controller'=>'testcasesteps','action'=>'add',$testcaseid), "update" => "Main"));
	?>
	</fieldset>
</div>
