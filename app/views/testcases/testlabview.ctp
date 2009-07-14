<div id = 'testcase' class="testcases view">
    <h1><?php echo $testcase['Testcase']['name']; ?></h1>
	<dl>

		<dt><?php __('Description'); ?></dt>
		<dd>
			<?php echo $testcase['Testcase']['description']; ?>
			&nbsp;
		</dd>
        <dt><?php __('Status'); ?></dt>
		<dd>
			<table>
            	<tr>
            	   <th style='width: 40%;'>Operating system</th>
            	   <th style='width: 40%;'>Browser</th>
            	   <th>Results</th>
            	</tr>
            	<?php
                    //pr($combinations); 
                    foreach($combinations as $combination){
                        $status = $combination['Result']['Test']['status'];
                        if(empty($status)){$status = 'notdone';} 
                        echo "<tr class='$status'>";                        
                        echo "<td>".$combination['Operatingsystem']['name']."</td>";
                        echo "<td>".$combination['Browser']['name']."</td>";
                        echo "<td>";
                        if(!empty($combination['Result'])){
                            echo $html->link($html->image('tango/32x32/categories/applications-other.png'),'#/Tests/view/'.$combination['Result']['Test']['id'],null,null,false);
                        }
                        echo "</td>";
                        echo "</tr>"; 
                    }
                ?>
            </table>
		</dd>
		<dt>Steps:</dt>
        <dd>
            <?php if(!empty($testcasesteps)): ?>
                <table>
                	<tr>
                        <th style='width: 50%;'>
                            Action
                		</th>
                        <th style='width: 50%;'>	
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