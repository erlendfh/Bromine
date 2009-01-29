<div class="testcases form">
<?php echo $form->create('Testcase');?>
	<fieldset>
 		<legend><?php __('Edit Testcase');?></legend>
	<?php

		echo $form->input('name');
		echo $form->hidden('project_id',array('value' => $session->read('project_id')));
		echo $form->input('description');
		echo $form->input('Requirement');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<ol id='sort'>
<?php foreach ($testcasesteps as $testcasestep): ?>
	<li id='item_<?php echo $testcasestep['TestcaseStep']['id']; ?>'>
		
			<?php echo $testcasestep['TestcaseStep']['action']; ?>
		
			<?php echo $testcasestep['TestcaseStep']['reaction']; ?>
		
			<?php echo $html->link(__('View', true), array('controller' => 'Testcasesteps', 'action'=>'view', $testcasestep['TestcaseStep']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('controller' => 'Testcasesteps', 'action'=>'edit', $testcasestep['TestcaseStep']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('controller' => 'Testcasesteps', 'action'=>'delete', $testcasestep['TestcaseStep']['id']), null, sprintf(__('Are you sure you want to delete %s?', true), $testcasestep['TestcaseStep']['id'])); ?>
        
	</li>
<?php endforeach; ?>
</ol>
<div id='output'></div>
<script type='text/javascript'>
Sortable.create("sort", {
    onUpdate: function() {
        new Ajax.Updater('output','/testcasesteps/reorder/'+<?php echo $testcasestep['TestcaseStep']['id'] ?>+'/'+Sortable.sequence("sort"));
        new Effect.Highlight('output');
    }
});
</script>

<?php echo $html->link(__('Add new step', true), array('controller' => 'Testcasesteps', 'action'=>'add' , $this->data['Testcase']['id'],$testcasestep['TestcaseStep']['orderby'] +1 )); ?>
