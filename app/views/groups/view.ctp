<div class="groups view">
<h2><?php  __('Group');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $group['Group']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $group['Group']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->aclLink(__('Edit Group', true), array('action'=>'edit', $group['Group']['id'])); ?> </li>
		<li><?php echo $html->aclLink(__('Delete Group', true), array('action'=>'delete', $group['Group']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $group['Group']['id'])); ?> </li>
		<li><?php echo $html->aclLink(__('List Groups', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Group', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->aclLink(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Users');?></h3>
	<?php if (!empty($group['User'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Firstname'); ?></th>
		<th><?php __('Lastname'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Password'); ?></th>
		<th><?php __('Usertype'); ?></th>
		<th><?php __('Email'); ?></th>
		<th><?php __('LastLogin'); ?></th>
		<th><?php __('Group Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($group['User'] as $user):
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
			<td><?php echo $user['usertype'];?></td>
			<td><?php echo $user['email'];?></td>
			<td><?php echo $user['lastLogin'];?></td>
			<td><?php echo $user['group_id'];?></td>
			<td class="actions">
				<?php echo $html->aclLink(__('View', true), array('controller'=> 'users', 'action'=>'view', $user['id'])); ?>
				<?php echo $html->aclLink(__('Edit', true), array('controller'=> 'users', 'action'=>'edit', $user['id'])); ?>
				<?php echo $html->aclLink(__('Delete', true), array('controller'=> 'users', 'action'=>'delete', $user['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->aclLink(__('New User', true), array('controller'=> 'users', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
