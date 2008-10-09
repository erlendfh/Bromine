<div class="defectstatuses index">
<h2><?php __('Defectstatuses');?></h2>
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
	<th><?php echo $paginator->sort('imgpath');?></th>
	<th><?php echo $paginator->sort('priority');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($defectstatuses as $defectstatus):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $defectstatus['Defectstatus']['id']; ?>
		</td>
		<td>
			<?php echo $defectstatus['Defectstatus']['name']; ?>
		</td>
		<td>
			<?php echo $defectstatus['Defectstatus']['imgpath']; ?>
		</td>
		<td>
			<?php echo $defectstatus['Defectstatus']['priority']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $defectstatus['Defectstatus']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $defectstatus['Defectstatus']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $defectstatus['Defectstatus']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $defectstatus['Defectstatus']['id'])); ?>
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
		<li><?php echo $html->link(__('New Defectstatus', true), array('action'=>'add')); ?></li>
	</ul>
</div>
