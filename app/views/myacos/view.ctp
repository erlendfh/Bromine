<div class="myacos view">
<h2><?php  __('Myaco');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $myaco['Myaco']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Parent Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $myaco['Myaco']['parent_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Alias'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $myaco['Myaco']['alias']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Myaco', true), array('action'=>'edit', $myaco['Myaco']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Myaco', true), array('action'=>'delete', $myaco['Myaco']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $myaco['Myaco']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Myacos', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Myaco', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Myaros', true), array('controller'=> 'myaros', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Myaro', true), array('controller'=> 'myaros', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Myaros');?></h3>
	<?php if (!empty($myaco['Myaro'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Parent Id'); ?></th>
		<th><?php __('Alias'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($myaco['Myaro'] as $myaro):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $myaro['id'];?></td>
			<td><?php echo $myaro['parent_id'];?></td>
			<td><?php echo $myaro['alias'];?></td>
			<td class="actions">
				<?php echo $html->link(__('View', true), array('controller'=> 'myaros', 'action'=>'view', $myaro['id'])); ?>
				<?php echo $html->link(__('Edit', true), array('controller'=> 'myaros', 'action'=>'edit', $myaro['id'])); ?>
				<?php echo $html->link(__('Delete', true), array('controller'=> 'myaros', 'action'=>'delete', $myaro['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $myaro['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->link(__('New Myaro', true), array('controller'=> 'myaros', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
