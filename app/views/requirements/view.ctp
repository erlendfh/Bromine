<div class="requirements view">
<h2><?php  __('Requirement');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $requirement['Requirement']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $requirement['Requirement']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $requirement['Requirement']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Project'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($requirement['Project']['name'], array('controller'=> 'projects', 'action'=>'view', $requirement['Project']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nr'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $requirement['Requirement']['nr']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($requirement['User']['name'], array('controller'=> 'users', 'action'=>'view', $requirement['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Priority'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $requirement['Requirement']['priority']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Requirement', true), array('action'=>'edit', $requirement['Requirement']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Requirement', true), array('action'=>'delete', $requirement['Requirement']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $requirement['Requirement']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Requirements', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Requirement', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Projects', true), array('controller'=> 'projects', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Project', true), array('controller'=> 'projects', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Testcases', true), array('controller'=> 'testcases', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Testcase', true), array('controller'=> 'testcases', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Testcases');?></h3>
	<?php if (!empty($requirement['Testcase'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Project Id'); ?></th>
		<th><?php __('Description'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($requirement['Testcase'] as $testcase):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $testcase['id'];?></td>
			<td><?php echo $testcase['name'];?></td>
			<td><?php echo $testcase['project_id'];?></td>
			<td><?php echo $testcase['description'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'testcases', 'action'=>'view', $testcase['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'testcases', 'action'=>'edit', $testcase['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'testcases', 'action'=>'delete', $testcase['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $testcase['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Testcase', true), array('controller'=> 'testcases', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
