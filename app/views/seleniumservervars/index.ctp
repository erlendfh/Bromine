<div class="seleniumservervars index">
<h2><?php __('Seleniumservervars');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('session');?></th>
	<th><?php echo $paginator->sort('nodepath');?></th>
	<th><?php echo $paginator->sort('uid');?></th>
	<th><?php echo $paginator->sort('test_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($seleniumservervars as $seleniumservervar):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $seleniumservervar['Seleniumservervar']['session']; ?>
		</td>
		<td>
			<?php echo $seleniumservervar['Seleniumservervar']['nodepath']; ?>
		</td>
		<td>
			<?php echo $seleniumservervar['Seleniumservervar']['uid']; ?>
		</td>
		<td>
			<?php echo $seleniumservervar['Seleniumservervar']['test_id']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $seleniumservervar['Seleniumservervar']['uid'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $seleniumservervar['Seleniumservervar']['uid'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $seleniumservervar['Seleniumservervar']['uid']), null, sprintf(__('Are you sure you want to delete # %s?', true), $seleniumservervar['Seleniumservervar']['uid'])); ?>
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
		<li><?php echo $html->link(__('New Seleniumservervar', true), array('action'=>'add')); ?></li>
	</ul>
</div>
