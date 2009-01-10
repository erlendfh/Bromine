<div class="myaros index">
<h2><?php __('Myaros');?></h2>
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
foreach ($myaros as $myaro):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $myaro['Myaro']['id']; ?>
		</td>
		<td>
			<?php echo $myaro['Myaro']['parent_id']; ?>
		</td>
		<td>
			<?php echo $myaro['Myaro']['alias']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $myaro['Myaro']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $myaro['Myaro']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $myaro['Myaro']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $myaro['Myaro']['id'])); ?>
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
		<li><?php echo $html->link(__('New Myaro', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Myacos', true), array('controller'=> 'myacos', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Myaco', true), array('controller'=> 'myacos', 'action'=>'add')); ?> </li>
	</ul>
</div>
