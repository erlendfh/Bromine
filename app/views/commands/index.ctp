<div class="commands index">
<h2><?php __('Commands');?></h2>
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
	<th><?php echo $paginator->sort('action');?></th>
	<th><?php echo $paginator->sort('var1');?></th>
	<th><?php echo $paginator->sort('var2');?></th>
	<th><?php echo $paginator->sort('test_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($commands as $command):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $command['Command']['id']; ?>
		</td>
		<td>
			<?php echo $command['Command']['status']; ?>
		</td>
		<td>
			<?php echo $command['Command']['action']; ?>
		</td>
		<td>
			<?php echo $command['Command']['var1']; ?>
		</td>
		<td>
			<?php echo $command['Command']['var2']; ?>
		</td>
		<td>
			<?php echo $html->link($command['Test']['name'], array('controller'=> 'tests', 'action'=>'view', $command['Test']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $command['Command']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $command['Command']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $command['Command']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $command['Command']['id'])); ?>
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
		<li><?php echo $html->link(__('New Command', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Tests', true), array('controller'=> 'tests', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Test', true), array('controller'=> 'tests', 'action'=>'add')); ?> </li>
	</ul>
</div>
