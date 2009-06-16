<div id = 'testcase' class="testcases view">
    <h2><?php  __('Testcase');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $testcase['Testcase']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $testcase['Testcase']['description']; ?>
			&nbsp;
		</dd>
        <dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Combinations'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
    		<? echo $table->createTable($browsers, $operatingsystems, $combinations, false, $requirement_id) ?>
    		&nbsp;
		</dd>
    </dl>
</div>
