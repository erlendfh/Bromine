<div class="defectstatuses view">
<h2><?php  __('Defectstatus');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $defectstatus['Defectstatus']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $defectstatus['Defectstatus']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Imgpath'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $defectstatus['Defectstatus']['imgpath']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Priority'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $defectstatus['Defectstatus']['priority']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->aclLink(__('Edit Defectstatus', true), array('action'=>'edit', $defectstatus['Defectstatus']['id'])); ?> </li>
		<li><?php echo $html->aclLink(__('Delete Defectstatus', true), array('action'=>'delete', $defectstatus['Defectstatus']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $defectstatus['Defectstatus']['id'])); ?> </li>
		<li><?php echo $html->aclLink(__('List Defectstatuses', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Defectstatus', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
