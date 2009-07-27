<div class="requirements view">
    <h1><?php  echo $requirement['Requirement']['name']; ?></h1>
	<dl>
        <dt><?php __('Description'); ?></dt>
		<dd>
			<?php echo $requirement['Requirement']['description']; ?>
			&nbsp;
		</dd>
		<dt><?php __('Run requirement'); ?></dt>
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
                elseif(empty($testcases)){
                    echo "<p class='error'>Error: There are no testcases assigned to this requirement. Please ".$html->link('assign','/Requirements')." some</p>";
                }
                elseif(empty($combinations)){
                    echo "<p class='error'>Error: There are no OS/browser combinations defined. Please ".$html->link('define','/Requirements#/Requirements/edit/'.$requirement['Requirement']['id'])." some</p>";
                }elseif(empty($onlineCombinations)){
                    echo "<p class='error'>Error: The online nodes have no browsers. Please ".$html->link('define','/Requirements#/Nodes')." some</p>";                    
                }elseif(count($offlineNeeds)>=count($combinations)){
                    echo "<p class='error'>Error: No online nodes meet the OS/browser combinations required. Please ".$html->link('define','/Requirements#/Nodes')." some that does</p>";
                }
                else{
                    echo $html->link($html->image("tango/32x32/actions/go-next.png").'', '/runrctests/runAndViewRequirement/'.$requirement['Requirement']['id'], array('onclick'=>'return Popup.open({url:this.href});'), null, false);
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
            	   
            	   <th>Timestamp</th>
            	   <th style='width: 25%;'>Testcase</th>
            	   <th style='width: 25%;'>Operating system</th>
            	   <th style='width: 25%;'>Browser</th>
            	   <th>Results</th>
            	</tr>
            	<?php
                    foreach($testcases as $testcase){
                        foreach($combinations as $combination){
                            echo "<tr class='".$combination['tc'.$testcase['id']]['status']."'>";
                            if ($combination['Result']['Test']['timestamp'] == 0){
                                echo "<td>N/A</td>"; 
                            }else{
                                echo "<td>".$time->timeAgoInWords($combination['Result']['Test']['timestamp'])."</td>"; 
                            }  
                            echo "<td>".$testcase['name']. "</td>";
                            echo "<td>".$combination['Operatingsystem']['name']."</td>";
                            echo "<td>".$combination['Browser']['name']."</td>";
                            echo "<td>";
                            if(!empty($combination['tc'.$testcase['id']]['status'])){
                                echo $html->link($html->image('tango/32x32/categories/applications-other.png'),'#/Tests/view/'.$combination['tc'.$testcase['id']]['Test_id'],null,null,false);
                            }
                            echo "</td>";
                            echo "</tr>";
                        }
                    }
                ?>
            </table>
		</dd>
	</dl>
	
</div>


<div id="log"></div>
