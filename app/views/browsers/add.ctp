<div class="browsers form">
<?php echo $form->create('Browser');?>
	<fieldset>
 		<legend><?php __('Add Browser');?></legend>
	<?php
		echo $form->input('browsername');
		echo $form->input('Node');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Browsers', true), array('action'=>'index'));?></li>
		<li><?php echo $html->link(__('List Suites', true), array('controller'=> 'suites', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Suite', true), array('controller'=> 'suites', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Nodes', true), array('controller'=> 'nodes', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Node', true), array('controller'=> 'nodes', 'action'=>'add')); ?> </li>
	</ul>
</div>
