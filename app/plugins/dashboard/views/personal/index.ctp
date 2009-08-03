<style>
div.item{
    border: 1px dashed grey;
}
div.inner{
    overflow: hidden;
}
div.draghandle{
    background-color: lightgrey;
    cursor: url('/img/openhand.cur'), pointer;
    height: 20px;
    width: 100%;
}
</style>
<?php

    foreach($items as $item){
        $id = $item['Personal']['id'];
        $posx = $item['Personal']['posx'].'px';
        $posy = $item['Personal']['posy'].'px';
        $width = $item['Personal']['width'].'px';
        $height = $item['Personal']['height'].'px';
        echo "<div id='item$id' style='margin-left: $posx; margin-top: $posy; width: $width; height: $height;' class='item'>";
        echo "<div class='draghandle'></div>";
        echo "<div class='inner'>";
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

                echo $html->image($fp);
                
                break;
            case 'table':
                echo 'table';
                break;
        
        }
        echo "</div>";
        echo "</div>";
        ?>
        
        <script type='text/javascript'>
            id = 'item<?php echo $id ?>';
            new Draggable(id, {handle: 'draghandle', snap: [20, 20],   
                onEnd:function(){
                
                    top = parseFloat(<?php echo str_replace('px','',$posy); ?>) + parseFloat($(id).getStyle('top'));
                    left = parseFloat(<?php echo str_replace('px','',$posx); ?>) + parseFloat($(id).getStyle('left'));
                    new Ajax.Updater('log','personal/updateItemPosition/'+<?php echo $id ?>+'/'+left+'/'+top);   
                }
            });
        </script>
        
        <?php
    }
    //pr($items);
?>
<!--div id='log'></div-->
