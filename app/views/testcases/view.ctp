<div style='float: right;'>
    <?php echo 
        $ajax->link( 
            'Edit', 
            array( 'controller' => 'testcases', 'action' => 'edit', $testcase['Testcase']['id']), 
            array( 'update' => 'Main', 'class'=>'testcases view', 'id' => 'edit'));
    ?>
</div>
<div id ='testcase' class="testcases view">
<h1><?php echo $testcase['Testcase']['name']; ?></h1>
	<dl>
		<dt><?php __('Description'); ?></dt>
		<dd>
			<?php echo $testcase['Testcase']['description']; ?>
			&nbsp;
		</dd>
		<dt>Testscript</dt>
		<dd>
		<?php if(isset($testscript)): ?>
            <?php echo $html->image('tango/32x32/mimetypes/application-x-executable.png'); ?>
            <?php echo $html->link('View testscript',array('controller'=>'testcases', 'action'=>'viewscript', $testcase['Testcase']['id']),array('onclick'=>'return Popup.open({url:this.href});')); ?>
    	<?php else: ?>
    	   No testscript uploaded
		<?php endif; ?>
		</dd>
        <dt>Steps:</dt>
        <dd>
            <?php if(!empty($testcasesteps)): ?>
                <table>
                	<tr>
                        <th style='width: 250px; padding: 5px;'>
                            Action
                		</th>
                        <th style='width: 250px; padding: 5px;'>	
                            Reaction
                		</th>
                	</tr>
                <?php foreach($testcasesteps as $testcasestep): ?>
            		<tr style='height: 40px; vertical-align: top;'>
                        <td style='width: 250px; border: 1px solid lightgrey; padding: 5px;'>
                            <?php echo $testcasestep['TestcaseStep']['action']; ?>
            			</td>
            	        <td style='width: 250px; border: 1px solid lightgrey; padding: 5px;'>	
                            <?php echo $testcasestep['TestcaseStep']['reaction']; ?>
            			</td>
            		</tr>
                <?php endforeach; ?>
                </table>
            <?php endif ?>
        </dd>
    </dl>
</div>




