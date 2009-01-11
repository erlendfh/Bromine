<div class="testcases index">
<h2><?php __('Testcases');?></h2>
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
	<th><?php echo $paginator->sort('project_id');?></th>
	<th><?php echo $paginator->sort('description');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($testcases as $testcase):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $testcase['Testcase']['id']; ?>
		</td>
		<td>
			<?php echo $testcase['Testcase']['name']; ?>
		</td>
		<td>
			<?php echo $html->link($testcase['Project']['name'], array('controller'=> 'projects', 'action'=>'view', $testcase['Project']['id'])); ?>
		</td>
		<td>
			<?php echo $testcase['Testcase']['description']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $testcase['Testcase']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $testcase['Testcase']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $testcase['Testcase']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $testcase['Testcase']['id'])); ?>
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
		<li><?php echo $html->link(__('New Testcase', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Projects', true), array('controller'=> 'projects', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Project', true), array('controller'=> 'projects', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Testcasesteps', true), array('controller'=> 'testcasesteps', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Testcase Step', true), array('controller'=> 'testcasesteps', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Requirements', true), array('controller'=> 'requirements', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Requirement', true), array('controller'=> 'requirements', 'action'=>'add')); ?> </li>
	</ul>
</div>
