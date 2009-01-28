<div class="coretestsuites view">
<h2><?php  __('Coretestsuite');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $coretestsuite['Coretestsuite']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Project'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->aclLink($coretestsuite['Project']['name'], array('controller'=> 'projects', 'action'=>'view', $coretestsuite['Project']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Testsuite'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $coretestsuite['Coretestsuite']['testsuite']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->aclLink(__('Edit Coretestsuite', true), array('action'=>'edit', $coretestsuite['Coretestsuite']['id'])); ?> </li>
		<li><?php echo $html->aclLink(__('Delete Coretestsuite', true), array('action'=>'delete', $coretestsuite['Coretestsuite']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $coretestsuite['Coretestsuite']['id'])); ?> </li>
		<li><?php echo $html->aclLink(__('List Coretestsuites', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Coretestsuite', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->aclLink(__('List Projects', true), array('controller'=> 'projects', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Project', true), array('controller'=> 'projects', 'action'=>'add')); ?> </li>
	</ul>
</div>
