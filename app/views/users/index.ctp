<div class="users index">
<h1><?php __('Users');?></h1>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('name');?></th>
    <th><?php echo $paginator->sort('firstname');?></th>
	<th><?php echo $paginator->sort('lastname');?></th>
	<th><?php echo $paginator->sort('group_id');?></th>
	<th><?php echo $paginator->sort('email');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($users as $user):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $user['User']['name']; ?>
		</td>
        <td>
			<?php echo $user['User']['firstname']; ?>
		</td>
		<td>
			<?php echo $user['User']['lastname']; ?>
		</td>
		<td>
			<?php echo $user['Group']['name']; ?>
		</td>
		<td>
			<?php echo $user['User']['email']; ?>
		</td>
		<td class="actions">
			<?php echo $html->aclLink(__('View', true), array('action'=>'view', $user['User']['id'])); ?>
			<?php echo $html->aclLink(__('Edit', true), array('action'=>'edit', $user['User']['id'])); ?>
			<?php echo $html->aclLink(__('Delete', true), array('action'=>'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); ?>
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
		<li><?php echo $html->aclLink(__('New User', true), array('action'=>'add')); ?></li>
	</ul>
</div>
