<?php echo $form->create('User', array('action' => 'assign')); ?>
<input type="hidden" name="data[Myaro][Myaro]" value="" />
<div class="users index">
<h2><?php __('Users');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>

<table cellpadding="0" cellspacing="0">
<tr>
    <th><?php echo __('Assign') ?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('firstname');?></th>
	<th><?php echo $paginator->sort('lastname');?></th>
	<th><?php echo $paginator->sort('group_id');?></th>
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
			<?php
                $id = $user['User']['id'];        
                $aroid = $user['Myaro']['id'];
                $checked = '';
                $disabled = '';

                if(in_array($id, $assigned_users)){
                    $checked = 'checked';
                }
                if(in_array($id, $admin_users)){
                    $disabled = 'disabled';
                }
                echo "<input type='checkbox' value='$aroid' name='data[Myaro][Myaro][]' $checked $disabled />";
            ?>
		</td>
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
	</tr>
<?php endforeach; ?>
</table>

</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<?php echo $form->end('Submit'); ?>
