<div class="suites view">
<h2><?php  __('Suite');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $suite['Suite']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $suite['Suite']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Site'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($suite['Site']['name'], array('controller'=> 'sites', 'action'=>'view', $suite['Site']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $suite['Suite']['status']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Timedate'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $suite['Suite']['timedate']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Timetaken'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $suite['Suite']['timetaken']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Browser'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($suite['Browser']['id'], array('controller'=> 'browsers', 'action'=>'view', $suite['Browser']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Operating System'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($suite['OperatingSystem']['name'], array('controller'=> 'operating_systems', 'action'=>'view', $suite['OperatingSystem']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Selenium Version'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $suite['Suite']['selenium_version']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Selenium Revision'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $suite['Suite']['selenium_revision']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Project'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($suite['Project']['name'], array('controller'=> 'projects', 'action'=>'view', $suite['Project']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Analysis'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $suite['Suite']['analysis']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Suite', true), array('action'=>'edit', $suite['Suite']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Suite', true), array('action'=>'delete', $suite['Suite']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $suite['Suite']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Suites', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Suite', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Sites', true), array('controller'=> 'sites', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Site', true), array('controller'=> 'sites', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Browsers', true), array('controller'=> 'browsers', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Browser', true), array('controller'=> 'browsers', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Operating Systems', true), array('controller'=> 'operating_systems', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Operating System', true), array('controller'=> 'operating_systems', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Projects', true), array('controller'=> 'projects', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Project', true), array('controller'=> 'projects', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Tests', true), array('controller'=> 'tests', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Test', true), array('controller'=> 'tests', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Tests');?></h3>
	<?php if (!empty($suite['Test'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Status'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Suite Id'); ?></th>
		<th><?php __('Help'); ?></th>
		<th><?php __('Manstatus'); ?></th>
		<th><?php __('Author'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($suite['Test'] as $test):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $test['id'];?></td>
			<td><?php echo $test['status'];?></td>
			<td><?php echo $test['name'];?></td>
			<td><?php echo $test['suite_id'];?></td>
			<td><?php echo $test['help'];?></td>
			<td><?php echo $test['manstatus'];?></td>
			<td><?php echo $test['author'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'tests', 'action'=>'view', $test['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'tests', 'action'=>'edit', $test['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'tests', 'action'=>'delete', $test['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $test['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Test', true), array('controller'=> 'tests', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
