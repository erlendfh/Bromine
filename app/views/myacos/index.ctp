<div class="myacos index">
<h2><?php __('Myacos');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('parent_id');?></th>
	<th><?php echo $paginator->sort('alias');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($myacos as $myaco):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $myaco['Myaco']['id']; ?>
		</td>
		<td>
			<?php echo $myaco['Myaco']['parent_id']; ?>
		</td>
		<td>
			<?php echo $myaco['Myaco']['alias']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $myaco['Myaco']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $myaco['Myaco']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $myaco['Myaco']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $myaco['Myaco']['id'])); ?>
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
		<li><?php echo $html->link(__('New Myaco', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Myaros', true), array('controller'=> 'myaros', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Myaro', true), array('controller'=> 'myaros', 'action'=>'add')); ?> </li>
	</ul>
</div>
