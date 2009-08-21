<div class="projects form">
<?php echo $form->create('Project');?>
	<fieldset>
 		<legend><?php __('Add Project');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('description');
		echo $form->input('newsite',array('label'=>'Sites', 'value' => 'http://www.', 'name' => 'data[Newsites][]'));
		echo "<div id='addsite'>";
		echo "</div>";
		echo $html->link('Add Site', '#', array('onclick'=>"
             new Ajax.Updater('addsite', '/sites/add', {
              insertion: Insertion.Bottom
            });
        "));
        echo $form->input('User');
		
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>