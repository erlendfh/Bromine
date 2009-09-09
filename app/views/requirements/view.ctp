<div style='float: right;'>
    <?php echo 
        $ajax->link( 
            'Edit', 
            array( 'controller' => 'requirements', 'action' => 'edit', $requirement['Requirement']['id']), 
            array( 'update' => 'Main', 'class'=>'requirements view', 'id' => 'edit'));
    ?>
</div>
<div class="requirements view">
<h1><?php echo $requirement['Requirement']['name']; ?></h1>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $requirement['Requirement']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Combinations'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
    		<? echo $table->createTable($browsers, $operatingsystems, $combinations, false, $requirement['Requirement']['id']) ?>
    		&nbsp;
		</dd>
	</dl>
</div>
<div id="log"></div>
