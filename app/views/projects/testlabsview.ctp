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
	   //pr($project);
        $sum = $passed+$notdone+$failed;
        //Hack around bug in phpgraphlib not handling zeros correct
        $notdone = $notdone + 0.01;
        $passed = $passed + 0.01;
        $failed = $failed + 0.01;
	   
        App::import('Vendor','phpgraphlib/phpgraphlib');
        App::import('Vendor','phpgraphlib/phpgraphlib_pie');
        $graph=new PHPGraphLibPie(400,200);
        $graph->setTitle("Testcases status. $sum testcases total");
        $data=array(
            "Passed"=>$passed,
            "Failed"=>$failed,
            "Not done"=>$notdone
        );
        
        
        $graph->addData($data);
        $graph->pie_avail_colors=array('passed','failed','notdone');
        $graph->setLabelTextColor("50,50,50");
        $graph->setLegendTextColor("50,50,50");
        $fp = $graph->createGraph();
    ?>
    <img src="<?php echo $fp; ?>" />
</div>
