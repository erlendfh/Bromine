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
<br />
<br />
<div id='sort'>
<?php foreach ($testcasesteps as $testcasestep): ?>

	<div class='container' style='cursor: url("/img/openhand.cur"), move; clear: both; border-top: 1px solid lightgrey;' id='item_<?php echo $testcasestep['TestcaseStep']['id']; ?>'>
		
			<div style='width: 300px; float: left;'>
                <?php echo $testcasestep['TestcaseStep']['action']; ?>
                
			</div>
	        <div>	
			 <?php echo $testcasestep['TestcaseStep']['reaction']; ?>
			</div>
        
	</div>
<?php endforeach; ?>
</div>
<div id='output'></div>
<script type='text/javascript'>
Sortable.create("sort", {
    tag: 'div',
    only: 'container',
    onUpdate: function() {
        new Ajax.Updater('output','/testcasesteps/reorder/'+Sortable.sequence("sort"));
        new Effect.Highlight('sort');
    }
});
</script>

<?php echo $html->link(__('Add new step', true), array('controller' => 'Testcasesteps', 'action'=>'add' , $this->data['Testcase']['id'],$testcasestep['TestcaseStep']['orderby'] +1 )); ?>
<!--

-->
