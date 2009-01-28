<div class="configs index">
<h2><?php __('Configs');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('var');?></th>
	<th><?php echo $paginator->sort('value');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($configs as $config):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $config['Config']['id']; ?>
		</td>
		<td>
			<?php echo $config['Config']['var']; ?>
		</td>
		<td>
			<?php echo $config['Config']['value']; ?>
		</td>
		<td class="actions">
			<?php echo $html->aclLink(__('View', true), array('action'=>'view', $config['Config']['id'])); ?>
			<?php echo $html->aclLink(__('Edit', true), array('action'=>'edit', $config['Config']['id'])); ?>
			<?php echo $html->aclLink(__('Delete', true), array('action'=>'delete', $config['Config']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $config['Config']['id'])); ?>
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
		<li><?php echo $html->aclLink(__('New Config', true), array('action'=>'add')); ?></li>
	</ul>
</div>
