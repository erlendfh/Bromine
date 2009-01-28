<div class="attachments view">
<h2><?php  __('Attachment');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachment['Attachment']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Path'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $attachment['Attachment']['path']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->aclLink(__('Edit Attachment', true), array('action'=>'edit', $attachment['Attachment']['id'])); ?> </li>
		<li><?php echo $html->aclLink(__('Delete Attachment', true), array('action'=>'delete', $attachment['Attachment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $attachment['Attachment']['id'])); ?> </li>
		<li><?php echo $html->aclLink(__('List Attachments', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Attachment', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
