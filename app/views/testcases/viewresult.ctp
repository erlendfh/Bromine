<div id = 'testcase' class="testcases view">
<h2><?php  __('Testcase');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $testresults[0]['Testcase']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $testresults[0]['Testcase']['description']; ?>
			&nbsp;
		</dd>
	





</div>
<table cellpadding="1" cellspacing="1">
<tr>
    <th>Time/date</th>
	<th>Name</th>
	<th>Status</th>
	<th>Browser</th>
	<th>Operatingsystem</th>
</tr>
<?php 
//pr($testresults);

$i = 0;
foreach ($testresults as $testresult){
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $testresult['Suite']['timedate']; ?>
		</td>
		<td>
			<?php echo $testresult['Test']['name']; ?>
		</td>
		<td>
			<?php echo $testresult['Test']['status']; ?>
		</td>
		<td>
			<?php echo $testresult['Browser']['name']; ?>
		</td>
		<td>
			<?php echo $testresult['Operatingsystem']['name']; ?>
		</td>
	</tr>

<?php } ?>
</table>