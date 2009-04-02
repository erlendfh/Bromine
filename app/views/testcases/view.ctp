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
if(!empty($testcasesteps)){
?>
<?php foreach($testcasesteps as $testcasestep): ?>
	<div class='container' id='item_<?php echo $testcasestep['TestcaseStep']['id']; ?>'>
		<table>
    		<tr style='height: 40px; vertical-align: top;'>
                <td style='width: 250px; border: 1px solid lightgrey; padding: 5px;'>
                    <?php echo $testcasestep['TestcaseStep']['action']; ?>
    			</td>
    	        <td style='width: 250px; border: 1px solid lightgrey; padding: 5px;'>	
                    <?php echo $testcasestep['TestcaseStep']['reaction']; ?>
    			</td>
    		</tr>
        </table>
	</div>
<?php endforeach; }?>

</div>




