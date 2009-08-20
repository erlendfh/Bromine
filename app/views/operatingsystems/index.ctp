<div class="operatingsystems index">
<h1><?php __('Operatingsystems');?></h1>
<table cellpadding="0" cellspacing="0">
<tr>
	<th> Name </th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($operatingsystems as $operatingsystem):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $operatingsystem['Operatingsystem']['name']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $operatingsystem['Operatingsystem']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $operatingsystem['Operatingsystem']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $operatingsystem['Operatingsystem']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $operatingsystem['Operatingsystem']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Operatingsystem', true), array('action'=>'add')); ?></li>
	</ul>
</div>
