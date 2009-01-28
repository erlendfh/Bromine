<div class="testcases form">
<?php echo $form->create('Testcase');?>
	<fieldset>
 		<legend><?php __('Edit Testcase');?></legend>
	<?php

		echo $form->input('name');
		echo $form->hidden('project_id',array('value' => $session->read('project_id')));
		echo $form->input('description');
		echo $form->input('Requirement');
	?>
<br />

<table cellpadding="0" cellspacing="0">
<tr>
	<th>order</th>
	<th>action</th>
	<th>reaction</th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;

foreach ($testcasesteps as $testcasestep):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $testcasestep['TestcaseStep']['orderby']; ?>
		</td>
		<td>
			<?php echo $testcasestep['TestcaseStep']['action']; ?>
		</td>
		<td>
			<?php echo $testcasestep['TestcaseStep']['reaction']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('controller' => 'Testcasesteps', 'action'=>'view', $testcasestep['TestcaseStep']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('controller' => 'Testcasesteps', 'action'=>'edit', $testcasestep['TestcaseStep']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('controller' => 'Testcasesteps', 'action'=>'delete', $testcasestep['TestcaseStep']['id']), null, sprintf(__('Are you sure you want to delete %s?', true), $testcasestep['TestcaseStep']['id'])); ?>
        </td>
	</tr>
	
<?php 
endforeach; ?>
</table>
<?php echo $html->link(__('Add new step', true), array('controller' => 'Testcasesteps', 'action'=>'add' , $this->data['Testcase']['id'],$testcasestep['TestcaseStep']['orderby'] +1 )); ?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>