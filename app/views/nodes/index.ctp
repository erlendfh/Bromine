<div class="nodes index">
<h1><?php __('Nodes');?></h1>
<table cellpadding="0" cellspacing="0">
<tr>
	<th>Status</th>
    <th>Description</th>
    <th>Operating system</th>
    <th>Nodepath</th>
    
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($nodes as $node):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $html->image($node['Node']['status'],array('height'=>'16px')); ?>
		</td>
        <td>
			<?php echo $node['Node']['description']; ?>
		</td>
        <td>
			<?php echo $node['Operatingsystem']['name']; ?>
		</td>
        <td>
			<?php echo $node['Node']['nodepath']; ?>
		</td>
		
		
		
		<td class="actions">
			<?php echo $ajax->link(__('View', true), array('action'=>'view', $node['Node']['id']), array('update'=>'Main')); ?>
			<?php echo $ajax->link(__('Edit', true), array('action'=>'edit', $node['Node']['id']), array('update'=>'Main')); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $node['Node']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $node['Node']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="actions">
	<ul>
		<li><?php echo $ajax->link(__('New Node', true), array('action'=>'add'), array('update'=>'Main')); ?></li>
		<!-- Outcommented because we need to figure out how to maintain all the combinations, when adding/deleting
        <li><?php echo $ajax->link(__('Manage Operating Systems', true), array('controller'=> 'operatingsystems', 'action'=>'index'), array('update'=>'Main')); ?> </li>
		<li><?php echo $ajax->link(__('Manage Browsers', true), array('controller'=> 'browsers', 'action'=>'index'), array('update'=>'Main')); ?> </li>
		-->
	</ul>
</div>
