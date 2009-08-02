<?php

    foreach($items as $item){
        $posx = $item['Personal']['posx'].'px';
        $posy = $item['Personal']['posy'].'px';
        $width = $item['Personal']['width'].'px';
        $height = $item['Personal']['height'].'px';
        echo "<div 'style='margin-left: $posx; margin-top: $posy; width: $width; height: $height; border: 1px solid black;'>";
        switch ($item['DashboardType']['name']){
            case 'pie':
                App::import('Vendor','phpgraphlib/phpgraphlib');
                App::import('Vendor','phpgraphlib/phpgraphlib_pie');
                $graph=new PHPGraphLibPie(400,200);
                $graph->setTitle("Testcases status. testcases total");
                
                $graph->addData($item['Personal']['sql'][0][0]);
                //$graph->pie_avail_colors=$colors;
 
                $graph->setLabelTextColor("50,50,50");
                $graph->setLegendTextColor("50,50,50");
                $fp = $graph->createGraph();

                echo "<img src='".WWW_ROOT."$fp' />";
                
                break;
            case 'table':
                echo 'table';
                break;
        
        }
        echo "</div>";
    }
    //pr($items);
?>