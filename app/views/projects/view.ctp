<div class="projects view">
<h2><?php  __('Project');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $project['Project']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $project['Project']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $project['Project']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Outsidedefects'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $project['Project']['outsidedefects']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Viewdefectsurl'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $project['Project']['viewdefectsurl']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Adddefecturl'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $project['Project']['adddefecturl']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Project', true), array('action'=>'edit', $project['Project']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Project', true), array('action'=>'delete', $project['Project']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $project['Project']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Projects', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Project', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Requirements', true), array('controller'=> 'requirements', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Requirement', true), array('controller'=> 'requirements', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Sites', true), array('controller'=> 'sites', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Site', true), array('controller'=> 'sites', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Suites', true), array('controller'=> 'suites', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Suite', true), array('controller'=> 'suites', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Testcases', true), array('controller'=> 'testcases', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Testcase', true), array('controller'=> 'testcases', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Requirements');?></h3>
	<?php if (!empty($project['Requirement'])):?>
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
		foreach ($project['Requirement'] as $requirement):
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
<div class="related">
	<h3><?php __('Related Sites');?></h3>
	<?php if (!empty($project['Site'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Project Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($project['Site'] as $site):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $site['id'];?></td>
			<td><?php echo $site['name'];?></td>
			<td><?php echo $site['project_id'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'sites', 'action'=>'view', $site['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'sites', 'action'=>'edit', $site['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'sites', 'action'=>'delete', $site['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $site['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Site', true), array('controller'=> 'sites', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Suites');?></h3>
	<?php if (!empty($project['Suite'])):?>
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
		foreach ($project['Suite'] as $suite):
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
<div class="related">
	<h3><?php __('Related Testcases');?></h3>
	<?php if (!empty($project['Testcase'])):?>
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
		foreach ($project['Testcase'] as $testcase):
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
