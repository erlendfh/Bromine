<div class="echelons index">
<h1><?php __('Logs');?></h1>
<h3>Logging is currently set to: <?php echo $echelon;?></h3>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('url');?></th>
	<th><?php echo $paginator->sort('User','user_id');?></th>
	<th><?php echo $paginator->sort('ip');?></th>
	<th><?php echo $paginator->sort('time');?></th>
</tr>
<?php
$i = 0;
foreach ($echelons as $echelon):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $echelon['Echelon']['url']; ?>
		</td>
		<td>
			<?php echo $echelon['User']['name']; ?>
		</td>
		<td>
			<?php echo $echelon['Echelon']['ip']; ?>
		</td>
		<td>
			<?php echo $time->timeAgoInWords($echelon['Echelon']['time']); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>