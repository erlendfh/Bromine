<div class="operatingsystems index">
<h2><?php __('Operatingsystems');?></h2>
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
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($operatingsystems as $operatingsystem):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $operatingsystem['Operatingsystem']['id']; ?>
		</td>
		<td>
			<?php echo $operatingsystem['Operatingsystem']['name']; ?>
		</td>
		<td class="actions">
			<?php echo $html->aclLink(__('View', true), array('action'=>'view', $operatingsystem['Operatingsystem']['id'])); ?>
			<?php echo $html->aclLink(__('Edit', true), array('action'=>'edit', $operatingsystem['Operatingsystem']['id'])); ?>
			<?php echo $html->aclLink(__('Delete', true), array('action'=>'delete', $operatingsystem['Operatingsystem']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $operatingsystem['Operatingsystem']['id'])); ?>
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
		<li><?php echo $html->aclLink(__('New Operatingsystem', true), array('action'=>'add')); ?></li>
	</ul>
</div>
