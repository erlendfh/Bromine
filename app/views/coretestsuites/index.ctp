<div class="coretestsuites index">
<h2><?php __('Coretestsuites');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('project_id');?></th>
	<th><?php echo $paginator->sort('testsuite');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($coretestsuites as $coretestsuite):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $coretestsuite['Coretestsuite']['id']; ?>
		</td>
		<td>
			<?php echo $html->link($coretestsuite['Project']['name'], array('controller'=> 'projects', 'action'=>'view', $coretestsuite['Project']['id'])); ?>
		</td>
		<td>
			<?php echo $coretestsuite['Coretestsuite']['testsuite']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $coretestsuite['Coretestsuite']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $coretestsuite['Coretestsuite']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $coretestsuite['Coretestsuite']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $coretestsuite['Coretestsuite']['id'])); ?>
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
		<li><?php echo $html->link(__('New Coretestsuite', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Projects', true), array('controller'=> 'projects', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Project', true), array('controller'=> 'projects', 'action'=>'add')); ?> </li>
	</ul>
</div>
