<div class="browsers view">
<h2><?php  __('Browser');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $browser['Browser']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $browser['Browser']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Path'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $browser['Browser']['path']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Browser', true), array('action'=>'edit', $browser['Browser']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Browser', true), array('action'=>'delete', $browser['Browser']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $browser['Browser']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Browsers', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Browser', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
