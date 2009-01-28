<div class="tempcommands index">
<h2><?php __('Tempcommands');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('uid');?></th>
	<th><?php echo $paginator->sort('action');?></th>
	<th><?php echo $paginator->sort('var1');?></th>
	<th><?php echo $paginator->sort('var2');?></th>
	<th><?php echo $paginator->sort('status');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($tempcommands as $tempcommand):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $tempcommand['Tempcommand']['id']; ?>
		</td>
		<td>
			<?php echo $tempcommand['Tempcommand']['uid']; ?>
		</td>
		<td>
			<?php echo $tempcommand['Tempcommand']['action']; ?>
		</td>
		<td>
			<?php echo $tempcommand['Tempcommand']['var1']; ?>
		</td>
		<td>
			<?php echo $tempcommand['Tempcommand']['var2']; ?>
		</td>
		<td>
			<?php echo $tempcommand['Tempcommand']['status']; ?>
		</td>
		<td class="actions">
			<?php echo $html->aclLink(__('View', true), array('action'=>'view', $tempcommand['Tempcommand']['id'])); ?>
			<?php echo $html->aclLink(__('Edit', true), array('action'=>'edit', $tempcommand['Tempcommand']['id'])); ?>
			<?php echo $html->aclLink(__('Delete', true), array('action'=>'delete', $tempcommand['Tempcommand']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $tempcommand['Tempcommand']['id'])); ?>
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
		<li><?php echo $html->aclLink(__('New Tempcommand', true), array('action'=>'add')); ?></li>
	</ul>
</div>
