<div class="sites view">
<h2><?php  __('Site');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $site['Site']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $site['Site']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Project'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($site['Project']['name'], array('controller'=> 'projects', 'action'=>'view', $site['Project']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Site', true), array('action'=>'edit', $site['Site']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Site', true), array('action'=>'delete', $site['Site']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $site['Site']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Sites', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Site', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Projects', true), array('controller'=> 'projects', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Project', true), array('controller'=> 'projects', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Suites', true), array('controller'=> 'suites', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Suite', true), array('controller'=> 'suites', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Suites');?></h3>
	<?php if (!empty($site['Suite'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Site Id'); ?></th>
		<th><?php __('Status'); ?></th>
		<th><?php __('Timedate'); ?></th>
		<th><?php __('Timetaken'); ?></th>
		<th><?php __('Browser Id'); ?></th>
		<th><?php __('Operating System Id'); ?></th>
		<th><?php __('Selenium Version'); ?></th>
		<th><?php __('Selenium Revision'); ?></th>
		<th><?php __('Project Id'); ?></th>
		<th><?php __('Analysis'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($site['Suite'] as $suite):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $suite['id'];?></td>
			<td><?php echo $suite['name'];?></td>
			<td><?php echo $suite['site_id'];?></td>
			<td><?php echo $suite['status'];?></td>
			<td><?php echo $suite['timedate'];?></td>
			<td><?php echo $suite['timetaken'];?></td>
			<td><?php echo $suite['browser_id'];?></td>
			<td><?php echo $suite['operating_system_id'];?></td>
			<td><?php echo $suite['selenium_version'];?></td>
			<td><?php echo $suite['selenium_revision'];?></td>
			<td><?php echo $suite['project_id'];?></td>
			<td><?php echo $suite['analysis'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'suites', 'action'=>'view', $suite['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'suites', 'action'=>'edit', $suite['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'suites', 'action'=>'delete', $suite['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $suite['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Suite', true), array('controller'=> 'suites', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
