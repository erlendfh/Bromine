<div class="defects view">
<h2><?php  __('Defect');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $defect['Defect']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->aclLink($defect['User']['name'], array('controller'=> 'users', 'action'=>'view', $defect['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $defect['Defect']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $defect['Defect']['type']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $defect['Defect']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updated'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $defect['Defect']['updated']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $defect['Defect']['status']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Project'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->aclLink($defect['Project']['name'], array('controller'=> 'projects', 'action'=>'view', $defect['Project']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Test'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->aclLink($defect['Test']['name'], array('controller'=> 'tests', 'action'=>'view', $defect['Test']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Updatedby'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $defect['Defect']['updatedby']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $defect['Defect']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Priority'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $defect['Defect']['priority']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Site'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->aclLink($defect['Site']['id'], array('controller'=> 'sites', 'action'=>'view', $defect['Site']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->aclLink(__('Edit Defect', true), array('action'=>'edit', $defect['Defect']['id'])); ?> </li>
		<li><?php echo $html->aclLink(__('Delete Defect', true), array('action'=>'delete', $defect['Defect']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $defect['Defect']['id'])); ?> </li>
		<li><?php echo $html->aclLink(__('List Defects', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Defect', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->aclLink(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
		<li><?php echo $html->aclLink(__('List Projects', true), array('controller'=> 'projects', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Project', true), array('controller'=> 'projects', 'action'=>'add')); ?> </li>
		<li><?php echo $html->aclLink(__('List Tests', true), array('controller'=> 'tests', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Test', true), array('controller'=> 'tests', 'action'=>'add')); ?> </li>
		<li><?php echo $html->aclLink(__('List Sites', true), array('controller'=> 'sites', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Site', true), array('controller'=> 'sites', 'action'=>'add')); ?> </li>
		<li><?php echo $html->aclLink(__('List Attachments', true), array('controller'=> 'attachments', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Attachment', true), array('controller'=> 'attachments', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Attachments');?></h3>
	<?php if (!empty($defect['Attachment'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Path'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($defect['Attachment'] as $attachment):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $attachment['id'];?></td>
			<td><?php echo $attachment['path'];?></td>
			<td class="actions">
				<?php echo $html->aclLink(__('View', true), array('controller'=> 'attachments', 'action'=>'view', $attachment['id'])); ?>
				<?php echo $html->aclLink(__('Edit', true), array('controller'=> 'attachments', 'action'=>'edit', $attachment['id'])); ?>
				<?php echo $html->aclLink(__('Delete', true), array('controller'=> 'attachments', 'action'=>'delete', $attachment['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $attachment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->aclLink(__('New Attachment', true), array('controller'=> 'attachments', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
