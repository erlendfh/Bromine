<div class="nodes form">
<?php echo $form->create('Node');?>
	<fieldset>
 		<legend><?php __('Add Node');?></legend>
	<?php
		echo $form->input('nodepath');
		echo $form->input('operating_system_id');
		echo $form->input('description');
		echo $form->input('network_drive');
		echo $form->input('Browser');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->aclLink(__('List Nodes', true), array('action'=>'index'));?></li>
		<li><?php echo $html->aclLink(__('List Operatingsystems', true), array('controller'=> 'operatingsystems', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Operatingsystem', true), array('controller'=> 'operatingsystems', 'action'=>'add')); ?> </li>
		<li><?php echo $html->aclLink(__('List Browsers', true), array('controller'=> 'browsers', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Browser', true), array('controller'=> 'browsers', 'action'=>'add')); ?> </li>
	</ul>
</div>
