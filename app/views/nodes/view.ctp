<div class="nodes view">
<h1><?php  __('Node');?></h1>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nodepath'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $node['Node']['nodepath']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Operatingsystem'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($node['Operatingsystem']['name'], array('controller'=> 'operatingsystems', 'action'=>'view', $node['Operatingsystem']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $node['Node']['description']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Node', true), array('action'=>'edit', $node['Node']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Node', true), array('action'=>'delete', $node['Node']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $node['Node']['id'])); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Browsers');?></h3>
	<?php if (!empty($node['Browser'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Name'); ?></th>
		<th><?php __('Path'); ?></th>
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
			<td><?php echo $browser['name'];?></td>
			<td><?php echo $browser['path'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'browsers', 'action'=>'view', $browser['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'browsers', 'action'=>'edit', $browser['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'browsers', 'action'=>'delete', $browser['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $browser['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>
