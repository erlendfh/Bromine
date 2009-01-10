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
			<?php echo $html->link($test['Suite']['name'], array('controller'=> 'suites', 'action'=>'view', $test['Suite']['id'])); ?>
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
		<li><?php echo $html->link(__('Edit Test', true), array('action'=>'edit', $test['Test']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Test', true), array('action'=>'delete', $test['Test']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $test['Test']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Tests', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Test', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Suites', true), array('controller'=> 'suites', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Suite', true), array('controller'=> 'suites', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Commands', true), array('controller'=> 'commands', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Command', true), array('controller'=> 'commands', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Seleniumservervars', true), array('controller'=> 'seleniumservervars', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Seleniumservervar', true), array('controller'=> 'seleniumservervars', 'action'=>'add')); ?> </li>
	</ul>
</div>
	<div class="related">
		<h3><?php  __('Related Commands');?></h3>
	<?php if (!empty($test['Command'])):?>
		<dl>	<?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $test['Command']['id'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $test['Command']['status'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Action');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $test['Command']['action'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Var1');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $test['Command']['var1'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Var2');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $test['Command']['var2'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Test Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $test['Command']['test_id'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $html->link(__('Edit Command', true), array('controller'=> 'commands', 'action'=>'edit', $test['Command']['id'])); ?></li>
			</ul>
		</div>
	</div>
		<div class="related">
		<h3><?php  __('Related Seleniumservervars');?></h3>
	<?php if (!empty($test['Seleniumservervar'])):?>
		<dl>	<?php $i = 0; $class = ' class="altrow"';?>
			<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Session');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $test['Seleniumservervar']['session'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nodepath');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $test['Seleniumservervar']['nodepath'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Uid');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $test['Seleniumservervar']['uid'];?>
&nbsp;</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Test Id');?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
	<?php echo $test['Seleniumservervar']['test_id'];?>
&nbsp;</dd>
		</dl>
	<?php endif; ?>
		<div class="actions">
			<ul>
				<li><?php echo $html->link(__('Edit Seleniumservervar', true), array('controller'=> 'seleniumservervars', 'action'=>'edit', $test['Seleniumservervar']['id'])); ?></li>
			</ul>
		</div>
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
				<?php echo $html->link(__('View', true), array('controller'=> 'commands', 'action'=>'view', $command['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'commands', 'action'=>'edit', $command['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'commands', 'action'=>'delete', $command['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $command['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Command', true), array('controller'=> 'commands', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Seleniumservervars');?></h3>
	<?php if (!empty($test['Seleniumservervar'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Session'); ?></th>
		<th><?php __('Nodepath'); ?></th>
		<th><?php __('Uid'); ?></th>
		<th><?php __('Test Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($test['Seleniumservervar'] as $seleniumservervar):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $seleniumservervar['session'];?></td>
			<td><?php echo $seleniumservervar['nodepath'];?></td>
			<td><?php echo $seleniumservervar['uid'];?></td>
			<td><?php echo $seleniumservervar['test_id'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'seleniumservervars', 'action'=>'view', $seleniumservervar['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'seleniumservervars', 'action'=>'edit', $seleniumservervar['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'seleniumservervars', 'action'=>'delete', $seleniumservervar['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $seleniumservervar['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Seleniumservervar', true), array('controller'=> 'seleniumservervars', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
