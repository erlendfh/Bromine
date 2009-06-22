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
            if(empty($testcases)){
                echo "There are no testcases to run. Please ".$html->link('assign','/Requirements')." some";
            }
            elseif(empty($combinations)){
                echo "There are no OS/browser combinations defined. Please ".$html->link('define','/Requirements/#edit/'.$requirement['Requirement']['id'])." some";
            }else{
                echo $html->link($html->image("tango/32x32/actions/go-next.png").'', '/runrctests/runAndViewRequirement/'.$requirement['Requirement']['id'], array('onclick'=>'return Popup.open({url:this.href});'), null, false);
            } 
            ?>
			&nbsp;
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
                            echo "<tr class='".$testcase['status']."'>";
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
