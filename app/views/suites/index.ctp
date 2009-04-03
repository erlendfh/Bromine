<div class="suites index">
<h2><?php __('Suites');?></h2>
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
	<th><?php echo $paginator->sort('site_id');?></th>
	<th><?php echo $paginator->sort('status');?></th>
	<th><?php echo $paginator->sort('timedate');?></th>
	<th><?php echo $paginator->sort('timetaken');?></th>
	<th><?php echo $paginator->sort('selenium_version');?></th>
	<th><?php echo $paginator->sort('project_id');?></th>
	<th><?php echo $paginator->sort('analysis');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($suites as $suite):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}

//pr($suite);
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $suite['Suite']['id']; ?>
		</td>
		<td>
			<?php echo $suite['Suite']['name']; ?>
		</td>
		<td>
			<?php echo $suite['Site']['name']; ?>
		</td>
		<td>
			<?php echo $suite['Suite']['timedate']; ?>
		</td>
		<td>
			<?php echo $suite['Suite']['timetaken']; ?>
		</td>
		<td>
			<?php echo $suite['Suite']['selenium_version']; ?>
		</td>
		<td>
			<?php echo $html->aclLink($suite['Project']['name'], array('controller'=> 'projects', 'action'=>'view', $suite['Project']['id'])); ?>
		</td>
		<td>
			<?php echo $suite['Suite']['analysis']; ?>
		</td>
		<td class="actions">
			<?php echo $html->aclLink(__('View', true), array('action'=>'view', $suite['Suite']['id'])); ?>
			<?php echo $html->aclLink(__('Edit', true), array('action'=>'edit', $suite['Suite']['id'])); ?>
			<?php echo $html->aclLink(__('Delete', true), array('action'=>'delete', $suite['Suite']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $suite['Suite']['id'])); ?>
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
		<li><?php echo $html->aclLink(__('New Suite', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->aclLink(__('List Projects', true), array('controller'=> 'projects', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Project', true), array('controller'=> 'projects', 'action'=>'add')); ?> </li>
		<li><?php echo $html->aclLink(__('List Tests', true), array('controller'=> 'tests', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Test', true), array('controller'=> 'tests', 'action'=>'add')); ?> </li>
	</ul>
</div>
