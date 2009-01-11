<div class="tests index">
<h2><?php __('Tests');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('status');?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('suite_id');?></th>
	<th><?php echo $paginator->sort('help');?></th>
	<th><?php echo $paginator->sort('manstatus');?></th>
	<th><?php echo $paginator->sort('author');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($tests as $test):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $test['Test']['id']; ?>
		</td>
		<td>
			<?php echo $test['Test']['status']; ?>
		</td>
		<td>
			<?php echo $test['Test']['name']; ?>
		</td>
		<td>
			<?php echo $html->link($test['Suite']['name'], array('controller'=> 'suites', 'action'=>'view', $test['Suite']['id'])); ?>
		</td>
		<td>
			<?php echo $test['Test']['help']; ?>
		</td>
		<td>
			<?php echo $test['Test']['manstatus']; ?>
		</td>
		<td>
			<?php echo $test['Test']['author']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $test['Test']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $test['Test']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $test['Test']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $test['Test']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Test', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Suites', true), array('controller'=> 'suites', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Suite', true), array('controller'=> 'suites', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Commands', true), array('controller'=> 'commands', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Command', true), array('controller'=> 'commands', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Defects', true), array('controller'=> 'defects', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Defect', true), array('controller'=> 'defects', 'action'=>'add')); ?> </li>
	</ul>
</div>
