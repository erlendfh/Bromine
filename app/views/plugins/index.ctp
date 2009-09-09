<div class="plugins index">
    <h1><?php __('Plugins');?></h1>
    <h3>Installed</h3>
    <table cellpadding="0" cellspacing="0">
    <tr>
    	<th><?php echo $paginator->sort('name');?></th>
    	<th>Description</th>
    	<th>Author</th>
    	<th>email</th>
    	<th>website</th>
    	<th><?php echo $paginator->sort('activated');?></th>
    	<th class="actions"><?php __('Actions');?></th>
    </tr>
    <?php
    $i = 0;
    foreach ($plugins as $plugin):
    	$class = null;
    	if ($i++ % 2 == 0) {
    		$class = ' class="altrow"';
    	}
    ?>
    	<tr<?php echo $class;?>>
    		<td>
    			<?php echo $plugin['Plugin']['name']; ?>
    		</td>
    		<td>
    			<?php echo $plugin['Plugin']['description']; ?>
    		</td>
    		<td>
    			<?php echo $plugin['Plugin']['author']; ?>
    		</td>
    		<td>
    			<?php echo $plugin['Plugin']['email']; ?>
    		</td>
    		<td>
    			<?php echo $plugin['Plugin']['website']; ?>
    		</td>
    		<td>
    			<?php
                    $activated = $plugin['Plugin']['activated'];
                    echo $activated ? "Yes" : "No"; ?>
    		</td>
    		<td class="actions">
    			<?php echo $html->link($activated ? 'Deactivate' : 'Activate', array('action' => $activated ? 'deactivate' : 'activate', $plugin['Plugin']['id'])); ?>
    			<?php echo $html->link('Uninstall', array('action' => 'uninstall', $plugin['Plugin']['id']), null, 'Are you sure you want to completely remove the '.$plugin['Plugin']['name'].' plugin?'); ?>
    		</td>
    	</tr>
    <?php endforeach; ?>
    </table>
    
    <div class="paging">
    	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
     | 	<?php echo $paginator->numbers();?>
    	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class' => 'disabled'));?>
    </div>
    <?php if(!empty($notInstalled)): ?>
    <h3>Not installed</h3>
    
    <table cellpadding="0" cellspacing="0">
    <tr>
    	<th><?php echo $paginator->sort('name');?></th>
    	<th>Description</th>
    	<th>Author</th>
    	<th>email</th>
    	<th>website</th>
    	<th class="actions"><?php __('Actions');?></th>
    </tr>
    <?php
    $i = 0;
    foreach ($notInstalled as $plugin):
    	$class = null;
    	if ($i++ % 2 == 0) {
    		$class = ' class="altrow"';
    	}
    ?>
    	<tr<?php echo $class;?>>
    		<td>
    			<?php echo $plugin['Plugin']['name']; ?>
    		</td>
    		<td>
    			<?php echo $plugin['Plugin']['description']; ?>
    		</td>
    		<td>
    			<?php echo $plugin['Plugin']['author']; ?>
    		</td>
    		<td>
    			<?php echo $plugin['Plugin']['email']; ?>
    		</td>
    		<td>
    			<?php echo $plugin['Plugin']['website']; ?>
    		</td>
    		<td class="actions">
    			<?php echo $html->link('Install', array('controller' => 'plugins' ,'action' => 'install', $plugin['Plugin']['name']),array('target'=>'_blank')); ?>
    		</td>
    	</tr>
    <?php endforeach; ?>
    </table>
    <?php endif ?>

</div>