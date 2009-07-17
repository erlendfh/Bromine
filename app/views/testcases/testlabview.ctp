<div id = 'testcase' class="testcases view">
    <h1><?php echo $testcase['Testcase']['name']; ?></h1>
	<dl>

		<dt><?php __('Description'); ?></dt>
		<dd>
			<?php echo $testcase['Testcase']['description']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Run testcase'); ?></dt>
		<dd>
			<?php
			     
                $onlineCombinations = array();
                foreach($onlineNodes as $onlineNode){
                    foreach($onlineNode['Browser'] as $browser){
                        $onlineCombinations[] = $onlineNode['Operatingsystem']['id'].','.$browser['id'];
                    }
                }
                $offlineNeeds =  array();
                foreach($combinations as $combination){
                    $idCombination = $combination['Operatingsystem']['id'].','.$combination['Browser']['id'];
                    if(!in_array($idCombination,$onlineCombinations)){
                        $offlineNeeds[] = $combination['Browser']['name'].' on '.$combination['Operatingsystem']['name'];
                    }
                }
    			if(empty($nodes)){
                    echo "<p class='error'>Error: There are no nodes defined. Please ".$html->link('add','/Requirements#/Nodes/add/').' some</p>';
                }
    			elseif(empty($onlineNodes)){
                    echo "<p class='error'>Error: There are no nodes online. Please start the Selenium Remote Control servers at:<br />";
                    foreach($nodes as $node){
                        echo $node['Node']['nodepath']."<br />";
                    }
                    echo "</p>";
                }   
                elseif(empty($combinations)){
                    echo "<p class='error'>Error: There are no OS/browser combinations defined. Please ".$html->link('define','/Requirements#/Requirements/edit/'.$requirement['Requirement']['id'])." some</p>";
                }elseif(empty($onlineCombinations)){
                    echo "<p class='error'>Error: The online nodes have no browsers. Please ".$html->link('define','/Requirements#/Nodes')." some</p>";                    
                }elseif(count($offlineNeeds)>=count($combinations)){
                    echo "<p class='error'>Error: No online nodes meet the OS/browser combinations required. Please ".$html->link('define','/Requirements#/Nodes')." some that does</p>";
                }
                else{
                    echo $html->link($html->image("tango/32x32/actions/go-next.png").'', '/runrctests/runAndViewTestcase/'.$testcase['Testcase']['id'].'/'.$requirement['Requirement']['id'], array('onclick'=>'return Popup.open({url:this.href});'), null, false);
                }
                 
                if(!empty($offlineNeeds) && !(count($offlineNeeds)>=count($combinations))){
                    echo "<p class='warning'>Warning: The following combinations will not be tested as there are no online nodes with that combination:<br />";
                    foreach($offlineNeeds as $offlineNeed){
                        echo $offlineNeed."<br />";
                    }
                    echo "</p>";
                }
                
                if(count($onlineNodes)<count($nodes) && !empty($onlineNodes) && !empty($nodes)){
                    echo "<p class='notice'>Notice: The following nodes are defined but not running. Starting them will increase performance:<br />";
                    $onlineNodePaths = array();
                    foreach($onlineNodes as $onlineNode){
                        $onlineNodePaths[]=$onlineNode['Node']['nodepath'];
                    }
                    foreach($nodes as $node){
                        if(!in_array($node['Node']['nodepath'],$onlineNodePaths)){
                            echo $node['Node']['nodepath']."<br />";
                        }
                    }
                    echo "</p>";
                }

            ?>
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
