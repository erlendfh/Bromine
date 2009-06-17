<div class="requirements view">
    <h2><?php  __('Requirement');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>

		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $requirement['Requirement']['name']; ?>
			&nbsp;
		</dd>
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

<?php echo $html->link($html->image("tango/32x32/actions/go-next.png").' Run requirement', '/runrctests/runAndViewRequirement/'.$requirement['Requirement']['id'], array('onclick'=>'return Popup.open({url:this.href});'), null, false); ?>
<div id="log"></div>
