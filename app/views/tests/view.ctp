<div class="tests view">
<h2><?php  __('Test');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $test['Test']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $test['Test']['status']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $test['Test']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Suite'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->aclLink($test['Suite']['name'], array('controller'=> 'suites', 'action'=>'view', $test['Suite']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Help'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $test['Test']['help']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Manstatus'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $test['Test']['manstatus']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Author'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $test['Test']['author']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->aclLink(__('Edit Test', true), array('action'=>'edit', $test['Test']['id'])); ?> </li>
		<li><?php echo $html->aclLink(__('Delete Test', true), array('action'=>'delete', $test['Test']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $test['Test']['id'])); ?> </li>
		<li><?php echo $html->aclLink(__('List Tests', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Test', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->aclLink(__('List Suites', true), array('controller'=> 'suites', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Suite', true), array('controller'=> 'suites', 'action'=>'add')); ?> </li>
		<li><?php echo $html->aclLink(__('List Commands', true), array('controller'=> 'commands', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Command', true), array('controller'=> 'commands', 'action'=>'add')); ?> </li>
		<li><?php echo $html->aclLink(__('List Defects', true), array('controller'=> 'defects', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Defect', true), array('controller'=> 'defects', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Commands');?></h3>
	<?php if (!empty($test['Command'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Status'); ?></th>
		<th><?php __('Action'); ?></th>
		<th><?php __('Var1'); ?></th>
		<th><?php __('Var2'); ?></th>
		<th><?php __('Test Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($test['Command'] as $command):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $command['id'];?></td>
			<td><?php echo $command['status'];?></td>
			<td><?php echo $command['action'];?></td>
			<td><?php echo $command['var1'];?></td>
			<td><?php echo $command['var2'];?></td>
			<td><?php echo $command['test_id'];?></td>
			<td class="actions">
				<?php echo $html->aclLink(__('View', true), array('controller'=> 'commands', 'action'=>'view', $command['id'])); ?>
				<?php echo $html->aclLink(__('Edit', true), array('controller'=> 'commands', 'action'=>'edit', $command['id'])); ?>
				<?php echo $html->aclLink(__('Delete', true), array('controller'=> 'commands', 'action'=>'delete', $command['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $command['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->aclLink(__('New Command', true), array('controller'=> 'commands', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Defects');?></h3>
	<?php if (!empty($test['Defect'])):?>
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
		foreach ($test['Defect'] as $defect):
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
				<?php echo $html->aclLink(__('View', true), array('controller'=> 'defects', 'action'=>'view', $defect['id'])); ?>
				<?php echo $html->aclLink(__('Edit', true), array('controller'=> 'defects', 'action'=>'edit', $defect['id'])); ?>
				<?php echo $html->aclLink(__('Delete', true), array('controller'=> 'defects', 'action'=>'delete', $defect['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $defect['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->aclLink(__('New Defect', true), array('controller'=> 'defects', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
