<div class="typeofdefects index">
<h2><?php __('Typeofdefects');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('priority');?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('imgpath');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($typeofdefects as $typeofdefect):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $typeofdefect['Typeofdefect']['id']; ?>
		</td>
		<td>
			<?php echo $typeofdefect['Typeofdefect']['priority']; ?>
		</td>
		<td>
			<?php echo $typeofdefect['Typeofdefect']['name']; ?>
		</td>
		<td>
			<?php echo $typeofdefect['Typeofdefect']['imgpath']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $typeofdefect['Typeofdefect']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $typeofdefect['Typeofdefect']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $typeofdefect['Typeofdefect']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $typeofdefect['Typeofdefect']['id'])); ?>
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
		<li><?php echo $html->link(__('New Typeofdefect', true), array('action'=>'add')); ?></li>
	</ul>
</div>
