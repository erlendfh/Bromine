<div class="tests index">
<h2><?php __('Tests');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('status');?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('suite_id');?></th>
	<th><?php echo $paginator->sort('help');?></th>
	<th><?php echo $paginator->sort('manstatus');?></th>
	<th><?php echo $paginator->sort('author');?></th>
	<th><?php echo $paginator->sort('browser_id');?></th>
	<th><?php echo $paginator->sort('operatingsystem_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($tests as $test):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $test['Test']['id']; ?>
		</td>
		<td>
			<?php echo $test['Test']['status']; ?>
		</td>
		<td>
			<?php echo $test['Test']['name']; ?>
		</td>
		<td>
			<?php echo $html->link($test['Suite']['name'], array('controller'=> 'suites', 'action'=>'view', $test['Suite']['id'])); ?>
		</td>
		<td>
			<?php echo $test['Test']['help']; ?>
		</td>
		<td>
			<?php echo $test['Test']['manstatus']; ?>
		</td>
		<td>
			<?php echo $test['Test']['author']; ?>
		</td>
		<td>
			<?php echo $html->link($test['Browser']['name'], array('controller'=> 'browsers', 'action'=>'view', $test['Browser']['id'])); ?>
		</td>
		<td>
			<?php echo $html->link($test['Operatingsystem']['name'], array('controller'=> 'operatingsystems', 'action'=>'view', $test['Operatingsystem']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $test['Test']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $test['Test']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $test['Test']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $test['Test']['id'])); ?>
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
		<li><?php echo $html->link(__('New Test', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->link(__('List Suites', true), array('controller'=> 'suites', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Suite', true), array('controller'=> 'suites', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Browsers', true), array('controller'=> 'browsers', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Browser', true), array('controller'=> 'browsers', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Operatingsystems', true), array('controller'=> 'operatingsystems', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Operatingsystem', true), array('controller'=> 'operatingsystems', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Commands', true), array('controller'=> 'commands', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Command', true), array('controller'=> 'commands', 'action'=>'add')); ?> </li>
		<li><?php echo $html->link(__('List Seleniumservers', true), array('controller'=> 'seleniumservers', 'action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Seleniumserver', true), array('controller'=> 'seleniumservers', 'action'=>'add')); ?> </li>
	</ul>
</div>
