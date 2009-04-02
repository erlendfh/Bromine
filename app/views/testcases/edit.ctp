<div style='float: right;'>
<?php

    echo $ajax->link( 
            'Cancel', 
            array( 'controller' => 'testcases', 'action' => 'view', $this->data['Testcase']['id']), 
            array( 'update' => 'Main', 'class'=>'testcases view', 'id' => 'cancel'));
?>
</div>
<div class="testcases form">
<?php echo $form->create('Testcase');?>
	<fieldset>
 		<legend><?php __('Edit Testcase');?></legend>
	<?php
		echo $form->input('name');
		echo $form->hidden('project_id',array('value' => $session->read('project_id')));
		echo $form->input('description');
		//echo $form->input('Requirement');
	   
        //pr($this->data);
        
    ?>
	</fieldset>

<?php     
    echo $ajax->link( 
            'Save testcase', 
            array( 'controller' => 'testcases', 'action' => 'view', $this->data['Testcase']['id']), 
            array( 'update' => 'Main', 'onclick' => "$('TestcaseEditForm').request();"));
            
?>
</div>
<br />
<br />
<div id='sort'>

<?php 
if (!empty($testcasesteps)){
foreach ($testcasesteps as $testcasestep): ?>

	<div class='container' style='cursor: url("/img/openhand.cur"), move; clear: both; border-top: 1px solid lightgrey;' id='item_<?php echo $testcasestep['TestcaseStep']['id']; ?>'>
		
			<div style='width: 300px; float: left;'>
                <?php echo $testcasestep['TestcaseStep']['action']; ?>
                
			</div>
	        <div>	
			 <?php echo $testcasestep['TestcaseStep']['reaction']; ?>
			</div>
        
	</div>
<?php endforeach; }?>

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

<?php 
    if (!empty($testcasesteps)){
        //echo $html->link(__('Add new step', true), array('controller' => 'Testcasesteps', 'action'=>'add' , $this->data['Testcase']['id'],$testcasestep['TestcaseStep']['orderby'] +1 ));
        
            echo $ajax->link( 
            'Add step', 
            array( 'controller' => 'Testcasesteps', 'action' => 'add', $this->data['Testcase']['id'],$testcasestep['TestcaseStep']['orderby'] +1 ), 
            array( 'update' => 'Main'));
    }
    else{
    
            echo $ajax->link( 
            'Add step', 
            array( 'controller' => 'Testcasesteps', 'action' => 'add', $this->data['Testcase']['id'],1), 
            array( 'update' => 'Main'));
    }
?>
<!--

-->
