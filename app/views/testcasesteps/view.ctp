<div class="testcasesteps view">
<h2><?php  __('Testcasestep');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $testcasestep['Testcasestep']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Orderby'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $testcasestep['Testcasestep']['orderby']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Action'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $testcasestep['Testcasestep']['action']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reaction'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $testcasestep['Testcasestep']['reaction']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Testcase'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $html->link($testcasestep['Testcase']['name'], array('controller'=> 'testcases', 'action'=>'view', $testcasestep['Testcase']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Testcasestep', true), array('action'=>'edit', $testcasestep['Testcasestep']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Testcasestep', true), array('action'=>'delete', $testcasestep['Testcasestep']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $testcasestep['Testcasestep']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Testcasesteps', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Testcasestep', true), array('action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Testcases', true), array('controller'=> 'testcases', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Testcase', true), array('controller'=> 'testcases', 'action'=>'add')); ?> </li>
	</ul>
</div>
