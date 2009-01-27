<div class="requirements index">
<h2><?php __('Requirements');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('description');?></th>
	<th><?php echo $paginator->sort('nr');?></th>
	<th><?php echo $paginator->sort('priority');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($requirements as $requirement):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
		    <?php echo $requirement['Requirement']['name']; ?>
		</td>
		<td>
			<?php echo $requirement['Requirement']['description']; ?>
		</td>
		<td>
			<?php echo $requirement['Requirement']['nr']; ?>
		</td>
		<td>
			<?php echo $requirement['Requirement']['priority']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $requirement['Requirement']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $requirement['Requirement']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $requirement['Requirement']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $requirement['Requirement']['id'])); ?>
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