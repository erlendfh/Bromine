<div class="nodes view">
<h2><?php  __('Node');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $node['Node']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nodepath'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $node['Node']['nodepath']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Operating System'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($node['OperatingSystem']['name'], array('controller'=> 'operating_systems', 'action'=>'view', $node['OperatingSystem']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $node['Node']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Network Drive'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $node['Node']['network_drive']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Node', true), array('action'=>'edit', $node['Node']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Node', true), array('action'=>'delete', $node['Node']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $node['Node']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Nodes', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Node', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Operating Systems', true), array('controller'=> 'operating_systems', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Operating System', true), array('controller'=> 'operating_systems', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Browsers', true), array('controller'=> 'browsers', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Browser', true), array('controller'=> 'browsers', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Browsers');?></h3>
	<?php if (!empty($node['Browser'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Browsername'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($node['Browser'] as $browser):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $browser['id'];?></td>
			<td><?php echo $browser['browsername'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'browsers', 'action'=>'view', $browser['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'browsers', 'action'=>'edit', $browser['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'browsers', 'action'=>'delete', $browser['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $browser['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Browser', true), array('controller'=> 'browsers', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
