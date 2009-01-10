<div class="testcases view">
<h2><?php  __('Testcase');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $testcase['Testcase']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $testcase['Testcase']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Project'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($testcase['Project']['name'], array('controller'=> 'projects', 'action'=>'view', $testcase['Project']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $testcase['Testcase']['description']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Testcase', true), array('action'=>'edit', $testcase['Testcase']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Testcase', true), array('action'=>'delete', $testcase['Testcase']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $testcase['Testcase']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Testcases', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Testcase', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Projects', true), array('controller'=> 'projects', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Project', true), array('controller'=> 'projects', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Testcasesteps', true), array('controller'=> 'testcasesteps', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Testcasestep', true), array('controller'=> 'testcasesteps', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Requirements', true), array('controller'=> 'requirements', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Requirement', true), array('controller'=> 'requirements', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Testcasesteps');?></h3>
	<?php if (!empty($testcase['Testcasestep'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Orderby'); ?></th>
		<th><?php __('Action'); ?></th>
		<th><?php __('Reaction'); ?></th>
		<th><?php __('Testcase Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($testcase['Testcasestep'] as $testcasestep):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $testcasestep['id'];?></td>
			<td><?php echo $testcasestep['orderby'];?></td>
			<td><?php echo $testcasestep['action'];?></td>
			<td><?php echo $testcasestep['reaction'];?></td>
			<td><?php echo $testcasestep['testcase_id'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'testcasesteps', 'action'=>'view', $testcasestep['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'testcasesteps', 'action'=>'edit', $testcasestep['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'testcasesteps', 'action'=>'delete', $testcasestep['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $testcasestep['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Testcasestep', true), array('controller'=> 'testcasesteps', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Requirements');?></h3>
	<?php if (!empty($testcase['Requirement'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Project Id'); ?></th>
		<th><?php __('Nr'); ?></th>
		<th><?php __('Priority'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($testcase['Requirement'] as $requirement):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $requirement['id'];?></td>
			<td><?php echo $requirement['name'];?></td>
			<td><?php echo $requirement['description'];?></td>
			<td><?php echo $requirement['project_id'];?></td>
			<td><?php echo $requirement['nr'];?></td>
			<td><?php echo $requirement['priority'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'requirements', 'action'=>'view', $requirement['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'requirements', 'action'=>'edit', $requirement['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'requirements', 'action'=>'delete', $requirement['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $requirement['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Requirement', true), array('controller'=> 'requirements', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
