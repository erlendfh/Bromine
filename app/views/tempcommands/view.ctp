<div class="tempcommands view">
<h2><?php  __('Tempcommand');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tempcommand['Tempcommand']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Uid'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tempcommand['Tempcommand']['uid']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Action'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tempcommand['Tempcommand']['action']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Var1'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tempcommand['Tempcommand']['var1']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Var2'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tempcommand['Tempcommand']['var2']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $tempcommand['Tempcommand']['status']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->aclLink(__('Edit Tempcommand', true), array('action'=>'edit', $tempcommand['Tempcommand']['id'])); ?> </li>
		<li><?php echo $html->aclLink(__('Delete Tempcommand', true), array('action'=>'delete', $tempcommand['Tempcommand']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tempcommand['Tempcommand']['id'])); ?> </li>
		<li><?php echo $html->aclLink(__('List Tempcommands', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Tempcommand', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
