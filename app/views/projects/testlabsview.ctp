<div class="projects view">
<h1><?php echo $project['Project']['name']; ?></h1>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $project['Project']['description']; ?>
			&nbsp;
		</dd>
	</dl>
	
	<?php

        $sum = $passed+$notdone+$failed;

        
        if ($passed != 0){
            $data['Passed'] = $passed;
            $colors[] = 'passed';
        }
        
        if ($failed != 0){
            $data['Failed'] = $failed;
            $colors[] = 'failed'; 
        }
        
        if ($notdone != 0){
            $data['Not done'] = $notdone;
            $colors[] = 'notdone'; 
        }
        
        if(!empty($data)){
            App::import('Vendor','phpgraphlib/phpgraphlib');
            App::import('Vendor','phpgraphlib/phpgraphlib_pie');
            $graph=new PHPGraphLibPie(400,200);
            $graph->setTitle("Testcases status. $sum testcases total");
            
            $graph->addData($data);
            $graph->pie_avail_colors=$colors;
            
            $graph->setLabelTextColor("50,50,50");
            $graph->setLegendTextColor("50,50,50");
            $fp = $graph->createGraph();
            echo "<img src='$fp' />";
        }
    ?>
    
</div>
