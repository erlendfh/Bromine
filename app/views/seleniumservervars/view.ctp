<div class="seleniumservervars view">
<h2><?php  __('Seleniumservervar');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Session'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $seleniumservervar['Seleniumservervar']['session']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Nodepath'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $seleniumservervar['Seleniumservervar']['nodepath']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Uid'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $seleniumservervar['Seleniumservervar']['uid']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Test Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $seleniumservervar['Seleniumservervar']['test_id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Seleniumservervar', true), array('action'=>'edit', $seleniumservervar['Seleniumservervar']['uid'])); ?> </li>
		<li><?php echo $html->link(__('Delete Seleniumservervar', true), array('action'=>'delete', $seleniumservervar['Seleniumservervar']['uid']), null, sprintf(__('Are you sure you want to delete # %s?', true), $seleniumservervar['Seleniumservervar']['uid'])); ?> </li>
		<li><?php echo $html->link(__('List Seleniumservervars', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Seleniumservervar', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
