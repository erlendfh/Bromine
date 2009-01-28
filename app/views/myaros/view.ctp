<div class="myaros view">
<h2><?php  __('Myaro');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $myaro['Myaro']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Parent Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $myaro['Myaro']['parent_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Alias'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $myaro['Myaro']['alias']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->aclLink(__('Edit Myaro', true), array('action'=>'edit', $myaro['Myaro']['id'])); ?> </li>
		<li><?php echo $html->aclLink(__('Delete Myaro', true), array('action'=>'delete', $myaro['Myaro']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $myaro['Myaro']['id'])); ?> </li>
		<li><?php echo $html->aclLink(__('List Myaros', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Myaro', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->aclLink(__('List Myacos', true), array('controller'=> 'myacos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Myaco', true), array('controller'=> 'myacos', 'action'=>'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Myacos');?></h3>
	<?php if (!empty($myaro['Myaco'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Parent Id'); ?></th>
		<th><?php __('Alias'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($myaro['Myaco'] as $myaco):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $myaco['id'];?></td>
			<td><?php echo $myaco['parent_id'];?></td>
			<td><?php echo $myaco['alias'];?></td>
			<td class="actions">
				<?php echo $html->aclLink(__('View', true), array('controller'=> 'myacos', 'action'=>'view', $myaco['id'])); ?>
				<?php echo $html->aclLink(__('Edit', true), array('controller'=> 'myacos', 'action'=>'edit', $myaco['id'])); ?>
				<?php echo $html->aclLink(__('Delete', true), array('controller'=> 'myacos', 'action'=>'delete', $myaco['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $myaco['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $html->aclLink(__('New Myaco', true), array('controller'=> 'myacos', 'action'=>'add'));?> </li>
		</ul>
	</div>
</div>
