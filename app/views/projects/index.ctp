<div class="projects index">
<h2><?php __('Projects');?></h2>
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
	<th><?php echo $paginator->sort('description');?></th>
	<th><?php echo $paginator->sort('outsidedefects');?></th>
	<th><?php echo $paginator->sort('viewdefectsurl');?></th>
	<th><?php echo $paginator->sort('adddefecturl');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($projects as $project):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $project['Project']['id']; ?>
		</td>
		<td>
			<?php echo $project['Project']['name']; ?>
		</td>
		<td>
			<?php echo $project['Project']['description']; ?>
		</td>
		<td>
			<?php echo $project['Project']['outsidedefects']; ?>
		</td>
		<td>
			<?php echo $project['Project']['viewdefectsurl']; ?>
		</td>
		<td>
			<?php echo $project['Project']['adddefecturl']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $project['Project']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $project['Project']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $project['Project']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $project['Project']['id'])); ?>
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
		<li><?php echo $html->link(__('New Project', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Requirements', true), array('controller'=> 'requirements', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Requirement', true), array('controller'=> 'requirements', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Sites', true), array('controller'=> 'sites', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Site', true), array('controller'=> 'sites', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Suites', true), array('controller'=> 'suites', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Suite', true), array('controller'=> 'suites', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Testcases', true), array('controller'=> 'testcases', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Testcase', true), array('controller'=> 'testcases', 'action'=>'add')); ?> </li>
	</ul>
</div>
