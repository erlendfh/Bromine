<div class="coresettings view">
<h2><?php  __('Coresetting');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $coresetting['Coresetting']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Site'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($coresetting['Site']['id'], array('controller'=> 'sites', 'action'=>'view', $coresetting['Site']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Project'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($coresetting['Project']['name'], array('controller'=> 'projects', 'action'=>'view', $coresetting['Project']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Location'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $coresetting['Coresetting']['location']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Testpath'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $coresetting['Coresetting']['testpath']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Coresetting', true), array('action'=>'edit', $coresetting['Coresetting']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Coresetting', true), array('action'=>'delete', $coresetting['Coresetting']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $coresetting['Coresetting']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Coresettings', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Coresetting', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Sites', true), array('controller'=> 'sites', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Site', true), array('controller'=> 'sites', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Projects', true), array('controller'=> 'projects', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Project', true), array('controller'=> 'projects', 'action'=>'add')); ?> </li>
	</ul>
</div>
