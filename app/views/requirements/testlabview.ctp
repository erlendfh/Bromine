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
    			if(empty($nodes)){
                    echo "<p class='err'>Error: There are no nodes defined. Please ".$html->link('add','/Requirements/#/Nodes/add/').' some</p>';
                }
    			elseif(empty($onlineNodes)){
                    echo "<p class='err'>Error: There are no nodes online. Please start the Selenium Remote Control servers at:<br />";
                    foreach($nodes as $node){
                        echo $node['Node']['nodepath']."<br />";
                    }
                    echo "</p>";
                }   
                elseif(empty($testcases)){
                    echo "<p class='err'>Error: There are no testcases assigned to this requirement. Please ".$html->link('assign','/Requirements')." some</p>";
                }
                elseif(empty($combinations)){
                    echo "<p class='err'>Error: There are no OS/browser combinations defined. Please ".$html->link('define','/Requirements/#/Requirements/edit/'.$requirement['Requirement']['id'])." some</p>";
                }else{
                    echo $html->link($html->image("tango/32x32/actions/go-next.png").'', '/runrctests/runAndViewRequirement/'.$requirement['Requirement']['id'], array('onclick'=>'return Popup.open({url:this.href});'), null, false);
                } 
    			if(count($onlineNodes)<count($nodes) && !empty($onlineNodes) && !empty($nodes)){
                    echo "<p class='warn'>Warning: Some nodes are defined but not running. Please start the Selenium Remote Control servers at:<br />";
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
                if(!empty($offlineNeeds)){
                    echo "<p class='warn'>Warning: The following combinations will not be tested as there are no online nodes with that combination:<br />";
                    foreach($offlineNeeds as $offlineNeed){
                        echo $offlineNeed."<br />";
                    }
                    echo "</p>";
                }

            ?>
		</dd>
		<dt><?php __('Status'); ?></dt>
		<dd>
			<table>
            	<tr>
            	   <th style='width: 33%;'>Testcase</th>
            	   <th style='width: 33%;'>Operating system</th>
            	   <th style='width: 33%;'>Browser</th>
            	</tr>
            	<?php
                    foreach($testcases as $testcase){
                        foreach($combinations as $combination){
                            echo "<tr class='".$combination['tc'.$testcase['id']]['status']."'>";
                            echo "<td>".$testcase['name']. "</td>";
                            echo "<td>".$combination['Operatingsystem']['name']."</td>";
                            echo "<td>".$combination['Browser']['name']."</td>";
                            echo "</tr>"; 
                        }
                    }
                ?>
            </table>
		</dd>
	</dl>
	
</div>


<div id="log"></div>
