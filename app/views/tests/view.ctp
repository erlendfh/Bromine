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
			<?php echo $test['Browser']['name']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Operating system'); ?></dt>
		<dd>
			<?php echo $test['Operatingsystem']['name']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Commands'); ?></dt>
		<dd>
			<?php if (!empty($test['Command'])):?>
            	<table cellpadding = "0" cellspacing = "0" style="width: 100%;">
                	<tr>
                		<th><?php __('Command'); ?></th>
                		<th><?php __('Locator'); ?></th>
                		<th><?php __('Value'); ?></th>
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
		<?php
            $filename = WWW_ROOT.'logs'.DS.'output'.$test['Seleniumserver']['uid'].'.txt';
            $log = file_get_contents($filename);
            if(!empty($log)){
                echo "<dt>Notice</dt>";
                echo "<dd><pre><p class='notice'>Notice: $log</p></pre></dd>";
            }
        ?>
	</dl>
</div>
