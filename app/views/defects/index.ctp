<div class="defects index">
<h2><?php __('Defects');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('user_id');?></th>
	<th><?php echo $paginator->sort('description');?></th>
	<th><?php echo $paginator->sort('type');?></th>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('updated');?></th>
	<th><?php echo $paginator->sort('status');?></th>
	<th><?php echo $paginator->sort('project_id');?></th>
	<th><?php echo $paginator->sort('test_id');?></th>
	<th><?php echo $paginator->sort('updatedby');?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('priority');?></th>
	<th><?php echo $paginator->sort('site_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($defects as $defect):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $defect['Defect']['id']; ?>
		</td>
		<td>
			<?php echo $html->aclLink($defect['User']['name'], array('controller'=> 'users', 'action'=>'view', $defect['User']['id'])); ?>
		</td>
		<td>
			<?php echo $defect['Defect']['description']; ?>
		</td>
		<td>
			<?php echo $defect['Defect']['type']; ?>
		</td>
		<td>
			<?php echo $defect['Defect']['created']; ?>
		</td>
		<td>
			<?php echo $defect['Defect']['updated']; ?>
		</td>
		<td>
			<?php echo $defect['Defect']['status']; ?>
		</td>
		<td>
			<?php echo $html->aclLink($defect['Project']['name'], array('controller'=> 'projects', 'action'=>'view', $defect['Project']['id'])); ?>
		</td>
		<td>
			<?php echo $html->aclLink($defect['Test']['name'], array('controller'=> 'tests', 'action'=>'view', $defect['Test']['id'])); ?>
		</td>
		<td>
			<?php echo $defect['Defect']['updatedby']; ?>
		</td>
		<td>
			<?php echo $defect['Defect']['name']; ?>
		</td>
		<td>
			<?php echo $defect['Defect']['priority']; ?>
		</td>
		<td>
			<?php echo $html->aclLink($defect['Site']['id'], array('controller'=> 'sites', 'action'=>'view', $defect['Site']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $html->aclLink(__('View', true), array('action'=>'view', $defect['Defect']['id'])); ?>
			<?php echo $html->aclLink(__('Edit', true), array('action'=>'edit', $defect['Defect']['id'])); ?>
			<?php echo $html->aclLink(__('Delete', true), array('action'=>'delete', $defect['Defect']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $defect['Defect']['id'])); ?>
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
		<li><?php echo $html->aclLink(__('New Defect', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->aclLink(__('List Users', true), array('controller'=> 'users', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New User', true), array('controller'=> 'users', 'action'=>'add')); ?> </li>
		<li><?php echo $html->aclLink(__('List Projects', true), array('controller'=> 'projects', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Project', true), array('controller'=> 'projects', 'action'=>'add')); ?> </li>
		<li><?php echo $html->aclLink(__('List Tests', true), array('controller'=> 'tests', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Test', true), array('controller'=> 'tests', 'action'=>'add')); ?> </li>
		<li><?php echo $html->aclLink(__('List Sites', true), array('controller'=> 'sites', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Site', true), array('controller'=> 'sites', 'action'=>'add')); ?> </li>
		<li><?php echo $html->aclLink(__('List Attachments', true), array('controller'=> 'attachments', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Attachment', true), array('controller'=> 'attachments', 'action'=>'add')); ?> </li>
	</ul>
</div>
