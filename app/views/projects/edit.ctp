<?php //pr($this->data) ?>
<div class="projects form">
<?php echo $form->create('Project');?>
	<fieldset>
 		<legend><?php __('Edit Project');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('description');
		
		echo "<label>Sites</label>";
		foreach($this->data['Site'] as $site){
            echo "<div class='input text' id='site".$site['id']."'><input name='data[Sites][".$site['id']."]' type='text' value='".$site['name']."' />";
            echo $html->link( 
                'Remove', 
                '#',
                array('onclick' => "
                    if(confirm('Are you sure you want to delete this site?')){
                    new Ajax.Request('/sites/delete/".$site['id']."'); 
                    $('site".$site['id']."').remove();}"
                )
            );
            echo "</div>";
        }
        echo "<div id='addsite'>";
		echo "</div>";
		echo $html->link('Add Site', '#', array('onclick'=>"
             new Ajax.Updater('addsite', '/sites/add', {
              insertion: Insertion.Bottom
            });
        "));
        
        echo $form->input('User',array('label'=>'Users'));
		
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Project.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Project.id'))); ?></li>
		<li><?php echo $html->link(__('List Projects', true), array('action'=>'index'));?></li>
	</ul>
</div>
