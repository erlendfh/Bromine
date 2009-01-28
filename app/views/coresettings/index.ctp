<div class="coresettings index">
<h2><?php __('Coresettings');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('site_id');?></th>
	<th><?php echo $paginator->sort('project_id');?></th>
	<th><?php echo $paginator->sort('location');?></th>
	<th><?php echo $paginator->sort('testpath');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($coresettings as $coresetting):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $coresetting['Coresetting']['id']; ?>
		</td>
		<td>
			<?php echo $html->aclLink($coresetting['Site']['name'], array('controller'=> 'sites', 'action'=>'view', $coresetting['Coresetting']['site_id'])); ?>
		</td>
		<td>
			<?php echo $html->aclLink($coresetting['Project']['name'], array('controller'=> 'projects', 'action'=>'view', $coresetting['Project']['id'])); ?>
		</td>
		<td>
			<?php echo $coresetting['Coresetting']['location']; ?>
		</td>
		<td>
			<?php echo $coresetting['Coresetting']['testpath']; ?>
		</td>
		<td class="actions">
			<?php echo $html->aclLink(__('View', true), array('action'=>'view', $coresetting['Coresetting']['id'])); ?>
			<?php echo $html->aclLink(__('Edit', true), array('action'=>'edit', $coresetting['Coresetting']['id'])); ?>
			<?php echo $html->aclLink(__('Delete', true), array('action'=>'delete', $coresetting['Coresetting']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $coresetting['Coresetting']['id'])); ?>
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
		<li><?php echo $html->aclLink(__('New Coresetting', true), array('action'=>'add')); ?></li>
		<li><?php echo $html->aclLink(__('List Sites', true), array('controller'=> 'sites', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Site', true), array('controller'=> 'sites', 'action'=>'add')); ?> </li>
		<li><?php echo $html->aclLink(__('List Projects', true), array('controller'=> 'projects', 'action'=>'index')); ?> </li>
		<li><?php echo $html->aclLink(__('New Project', true), array('controller'=> 'projects', 'action'=>'add')); ?> </li>
	</ul>
</div>
