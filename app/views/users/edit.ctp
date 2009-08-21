<div class="users form">
<?php echo $form->create('User');?>
	<fieldset>
 		<legend><?php __('Edit User');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
        echo $form->input('firstname');
		echo $form->input('lastname');
		echo "<a href='#' onclick='$(".'"'."changepw".'"'.").toggle();'>change password</a>";
        echo "<div id='changepw' style='display: none;'>";
		echo $form->input('newpw1',array('label'=>'New password', 'type'=>'password'));
		echo $form->input('newpw2',array('label'=>'New password', 'type'=>'password'));
		echo "</div>";
		echo $form->input('group_id');
		echo $form->input('email');
		echo $form->input('Project');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->aclLink(__('Delete', true), array('action'=>'delete', $form->value('User.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('User.id'))); ?></li>
	</ul>
</div>
