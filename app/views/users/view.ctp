<div class="users view">
<h2><?php  __('User');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Firstname'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['firstname']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Lastname'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['lastname']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Password'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['password']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Group id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['group_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['email']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('LastLogin'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['lastLogin']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit User', true), array('action'=>'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete User', true), array('action'=>'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Users', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New User', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Defects', true), array('controller'=> 'defects', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Defect', true), array('controller'=> 'defects', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Projects', true), array('controller'=> 'projects', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Project', true), array('controller'=> 'projects', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Requirements', true), array('controller'=> 'requirements', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Requirement', true), array('controller'=> 'requirements', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Defects');?></h3>
	<?php if (!empty($user['Defect'])):?>
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
		foreach ($user['Defect'] as $defect):
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
	<h3><?php __('Related Projects');?></h3>
	<?php if (!empty($user['Project'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Description'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Outsidedefects'); ?></th>
		<th><?php __('Viewdefectsurl'); ?></th>
		<th><?php __('Adddefecturl'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['Project'] as $project):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $project['id'];?></td>
			<td><?php echo $project['name'];?></td>
			<td><?php echo $project['description'];?></td>
			<td><?php echo $project['user_id'];?></td>
			<td><?php echo $project['outsidedefects'];?></td>
			<td><?php echo $project['viewdefectsurl'];?></td>
			<td><?php echo $project['adddefecturl'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'projects', 'action'=>'view', $project['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'projects', 'action'=>'edit', $project['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'projects', 'action'=>'delete', $project['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $project['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Project', true), array('controller'=> 'projects', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Requirements');?></h3>
	<?php if (!empty($user['Requirement'])):?>
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
		foreach ($user['Requirement'] as $requirement):
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
