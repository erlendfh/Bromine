<div class="browsers view">
<h2><?php  __('Browser');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $browser['Browser']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Browsername'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $browser['Browser']['browsername']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->aclLink(__('Edit Browser', true), array('action'=>'edit', $browser['Browser']['id'])); ?> </li>
		<li><?php echo $html->aclLink(__('Delete Browser', true), array('action'=>'delete', $browser['Browser']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $browser['Browser']['id'])); ?> </li>
		<li><?php echo $html->aclLink(__('List Browsers', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Browser', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
