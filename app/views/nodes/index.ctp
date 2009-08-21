<div class="nodes index">
<h1><?php __('Nodes');?></h1>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th> Online </th>
	<th><?php echo $paginator->sort('nodepath');?></th>
	<th><?php echo $paginator->sort('operatingsystem_id');?></th>
	<th><?php echo $paginator->sort('description');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
//pr($nodes);
foreach ($nodes as $node):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
        <td>
			<?php echo $html->image($node['Node']['status'],array('style'=>'height: 20px;')); ?>
		</td>
		<td>
			<?php echo $node['Node']['nodepath']; ?>
		</td>
		<td>
			<?php echo $html->link($node['Operatingsystem']['name'], array('controller'=> 'operatingsystems', 'action'=>'view', $node['Operatingsystem']['id'])); ?>
		</td>
		<td>
			<?php echo $node['Node']['description']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $node['Node']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $node['Node']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $node['Node']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $node['Node']['id'])); ?>
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
		<li><?php echo $html->link(__('New Node', true), array('action'=>'add')); ?></li>
	</ul>
</div>
