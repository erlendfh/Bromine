<div class="operatingsystems view">
<h2><?php  __('Operatingsystem');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $operatingsystem['Operatingsystem']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $operatingsystem['Operatingsystem']['name']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->aclLink(__('Edit Operatingsystem', true), array('action'=>'edit', $operatingsystem['Operatingsystem']['id'])); ?> </li>
		<li><?php echo $html->aclLink(__('Delete Operatingsystem', true), array('action'=>'delete', $operatingsystem['Operatingsystem']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $operatingsystem['Operatingsystem']['id'])); ?> </li>
		<li><?php echo $html->aclLink(__('List Operatingsystems', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Operatingsystem', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
