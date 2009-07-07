<div class="tests view">
<h1><?php echo $test['Test']['name']; ?></h1>
	<dl>
		<dt><?php __('Status'); ?></dt>
		<dd>
			<?php echo $test['Test']['status']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Browser'); ?></dt>
		<dd>
			<?php echo $html->link($test['Browser']['name'], array('controller'=> 'browsers', 'action'=>'view', $test['Browser']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php __('Operating system'); ?></dt>
		<dd>
			<?php echo $html->link($test['Operatingsystem']['name'], array('controller'=> 'operatingsystems', 'action'=>'view', $test['Operatingsystem']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php __('Commands'); ?></dt>
		<dd>
			<?php if (!empty($test['Command'])):?>
            	<table cellpadding = "0" cellspacing = "0" style="width: 100%;">
                	<tr>
                		<th><?php __('Action'); ?></th>
                		<th><?php __('Var1'); ?></th>
                		<th><?php __('Var2'); ?></th>
                	</tr>
            	<?php foreach ($test['Command'] as $command): ?>
            		<tr class='<?php echo $command['status'];?>'>
            			<td><?php echo $command['action'];?></td>
            			<td><?php echo $command['var1'];?></td>
            			<td><?php echo $command['var2'];?></td>
            		</tr>
            	<?php endforeach; ?>
            	</table>
            <?php endif; ?>
		</dd>
	</dl>
</div>
