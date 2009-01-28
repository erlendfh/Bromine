<div class="types index">
<h2><?php __('Types');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('command');?></th>
	<th><?php echo $paginator->sort('spacer');?></th>
	<th><?php echo $paginator->sort('extension');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($types as $type):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $type['Type']['id']; ?>
		</td>
		<td>
			<?php echo $type['Type']['name']; ?>
		</td>
		<td>
			<?php echo $type['Type']['command']; ?>
		</td>
		<td>
			<?php echo $type['Type']['spacer']; ?>
		</td>
		<td>
			<?php echo $type['Type']['extension']; ?>
		</td>
		<td class="actions">
			<?php echo $html->aclLink(__('View', true), array('action'=>'view', $type['Type']['id'])); ?>
			<?php echo $html->aclLink(__('Edit', true), array('action'=>'edit', $type['Type']['id'])); ?>
			<?php echo $html->aclLink(__('Delete', true), array('action'=>'delete', $type['Type']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $type['Type']['id'])); ?>
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
		<li><?php echo $html->aclLink(__('New Type', true), array('action'=>'add')); ?></li>
	</ul>
</div>
