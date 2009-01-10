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
		<li><?php echo $html->link(__('List Nodes', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Operating Systems', true), array('controller'=> 'operating_systems', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Operating System', true), array('controller'=> 'operating_systems', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Browsers', true), array('controller'=> 'browsers', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Browser', true), array('controller'=> 'browsers', 'action'=>'add')); ?> </li>
	</ul>
</div>
