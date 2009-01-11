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
		<li><?php echo $html->link(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Coresettings', true), array('controller'=> 'coresettings', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Coresetting', true), array('controller'=> 'coresettings', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Coretestsuites', true), array('controller'=> 'coretestsuites', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Coretestsuite', true), array('controller'=> 'coretestsuites', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Defects', true), array('controller'=> 'defects', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Defect', true), array('controller'=> 'defects', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Requirements', true), array('controller'=> 'requirements', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Requirement', true), array('controller'=> 'requirements', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Suites', true), array('controller'=> 'suites', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Suite', true), array('controller'=> 'suites', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Testcases', true), array('controller'=> 'testcases', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Testcase', true), array('controller'=> 'testcases', 'action'=>'add')); ?> </li>
	</ul>
</div>

<div class="related">
	<h3><?php __('Related Users');?></h3>
	<?php if (!empty($project['User'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Firstname'); ?></th>
		<th><?php __('Lastname'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Password'); ?></th>
		<th><?php __('Group_id'); ?></th>
		<th><?php __('Email'); ?></th>
		<th><?php __('LastLogin'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($project['User'] as $user):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $user['id'];?></td>
			<td><?php echo $user['firstname'];?></td>
			<td><?php echo $user['lastname'];?></td>
			<td><?php echo $user['name'];?></td>
			<td><?php echo $user['password'];?></td>
			<td><?php echo $user['group_id'];?></td>
			<td><?php echo $user['email'];?></td>
			<td><?php echo $user['lastLogin'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'user', 'action'=>'view', $user['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'user', 'action'=>'edit', $user['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'user', 'action'=>'delete', $user['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New User', true), array('controller'=> 'users', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>

<div class="related">
	<h3><?php __('Related Coresettings');?></h3>
	<?php if (!empty($project['Coresetting'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Site'); ?></th>
		<th><?php __('Project'); ?></th>
		<th><?php __('Location'); ?></th>
		<th><?php __('Testpath'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($project['Coresetting'] as $coresetting):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $coresetting['id'];?></td>
			<td><?php echo $coresetting['Site']['name']; ?></td>
			<td><?php echo $coresetting['Project']['name']; ?></td>
			<td><?php echo $coresetting['location'];?></td>
			<td><?php echo $coresetting['testpath'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'coresettings', 'action'=>'view', $coresetting['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'coresettings', 'action'=>'edit', $coresetting['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'coresettings', 'action'=>'delete', $coresetting['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $coresetting['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Coresetting', true), array('controller'=> 'coresettings', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Coretestsuites');?></h3>
	<?php if (!empty($project['Coretestsuite'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Project Id'); ?></th>
		<th><?php __('Testsuite'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($project['Coretestsuite'] as $coretestsuite):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $coretestsuite['id'];?></td>
			<td><?php echo $coretestsuite['project_id'];?></td>
			<td><?php echo $coretestsuite['testsuite'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'coretestsuites', 'action'=>'view', $coretestsuite['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'coretestsuites', 'action'=>'edit', $coretestsuite['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'coretestsuites', 'action'=>'delete', $coretestsuite['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $coretestsuite['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Coretestsuite', true), array('controller'=> 'coretestsuites', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>

<div class="related">
	<h3><?php __('Related Defects');?></h3>
	<?php if (!empty($project['Defect'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('Type'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Updated'); ?></th>
		<th><?php __('Status'); ?></th>
		<th><?php __('Project Id'); ?></th>
		<th><?php __('Test Id'); ?></th>
		<th><?php __('Updatedby'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Priority'); ?></th>
		<th><?php __('Site Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($project['Defect'] as $defect):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $defect['id'];?></td>
			<td><?php echo $defect['user_id'];?></td>
			<td><?php echo $defect['description'];?></td>
			<td><?php echo $defect['type'];?></td>
			<td><?php echo $defect['created'];?></td>
			<td><?php echo $defect['updated'];?></td>
			<td><?php echo $defect['status'];?></td>
			<td><?php echo $defect['project_id'];?></td>
			<td><?php echo $defect['test_id'];?></td>
			<td><?php echo $defect['updatedby'];?></td>
			<td><?php echo $defect['name'];?></td>
			<td><?php echo $defect['priority'];?></td>
			<td><?php echo $defect['site_id'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'defects', 'action'=>'view', $defect['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'defects', 'action'=>'edit', $defect['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'defects', 'action'=>'delete', $defect['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $defect['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Defect', true), array('controller'=> 'defects', 'action'=>'add'));?> </li>
		</ul>
	</div>
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
		<th><?php __('User Id'); ?></th>
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
			<td><?php echo $requirement['user_id'];?></td>
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
	<h3><?php __('Related Suites');?></h3>
	<?php if (!empty($project['Suite'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Site'); ?></th>
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
