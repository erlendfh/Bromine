<div style='float: right;'>
    <?php echo 
        $ajax->link( 
            'Edit', 
            array( 'controller' => 'testcases', 'action' => 'edit', $testcase['Testcase']['id']), 
            array( 'update' => 'Main', 'class'=>'testcases view', 'id' => 'edit'));
    ?>
</div>
<div id = 'testcase' class="testcases view">
<h2><?php  __('Testcase');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $testcase['Testcase']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $testcase['Testcase']['description']; ?>
			&nbsp;
		</dd>
	



<dt>Steps:</dt>

</div>
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




