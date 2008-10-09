<div class="typeofdefects view">
<h2><?php  __('Typeofdefect');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $typeofdefect['Typeofdefect']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Priority'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $typeofdefect['Typeofdefect']['priority']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $typeofdefect['Typeofdefect']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Imgpath'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $typeofdefect['Typeofdefect']['imgpath']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Typeofdefect', true), array('action'=>'edit', $typeofdefect['Typeofdefect']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Typeofdefect', true), array('action'=>'delete', $typeofdefect['Typeofdefect']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $typeofdefect['Typeofdefect']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Typeofdefects', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Typeofdefect', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
