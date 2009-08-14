<style>
div.item{
    border: 1px solid lightgrey;
    overflow: hidden;
}
div.inner{
    overflow: hidden;
    margin: 0px 0px 0px 0px;
    padding: 0px 0px 0px 0px;
}
div.draghandle{
    background-color: lightgrey;
    cursor: url('/img/openhand.cur'), pointer;
    height: 20px;
    width: 100%;
}
div.bottom{
    background: url('/img/resize-handle-bottom-right.gif') no-repeat;
    position: absolute;
    bottom: 0px;
    right: 0px;
    z-index: 5;
    height: 14px;
    width: 14px;

}
</style>
<?php

    foreach($items as $item){  
        $id = $item['Item']['id'];
        $posx = $item['Item']['posx'].'px';
        $posy = $item['Item']['posy'].'px';
        $width = $item['Item']['width'].'px';
        $height = $item['Item']['height'].'px';
        echo "<div id='item$id' style='margin-left: $posx; margin-top: $posy; width: $width; height: $height;' class='item'>";
            echo "<div class='draghandle'>";
                echo "<div style='float: right;'>" ;
                    echo $ajax->link( 
                        $html->image('tango/16x16/emblems/emblem-system.png'), 
                        array( 'controller' => 'items', 'action' => 'edit', $id), 
                        array( 'update' => "inner$id", 'escape'=>false)
                    );
                echo "</div>";
            echo "</div>";
            echo "<div class='inner' id='inner$id'>";
            switch ($item['DashboardType']['name']){
                case 'pie':
                    App::import('Vendor','phpgraphlib/phpgraphlib');
                    App::import('Vendor','phpgraphlib/phpgraphlib_pie');
                    $graph=new PHPGraphLibPie(400,100);
                    
                    $graph->addData($item['Item']['sql'][0][0]);
     
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
            echo "<div class='bottom'>&nbsp;</div>";
        echo "</div>";
        ?>
        
        <script type='text/javascript'>
            id = 'item<?php echo $id ?>';
            new Draggable(id, {handle: 'draghandle', snap: [10, 10],   
                onEnd:function(){
                    top =  parseFloat(<?php echo str_replace('px','',$posy); ?>) + parseFloat($(id).getStyle('top'));
                    left = parseFloat(<?php echo str_replace('px','',$posx); ?>) + parseFloat($(id).getStyle('left'));
                    new Ajax.Updater('log','items/updateItemPosition/'+<?php echo $id ?>+'/'+left+'/'+top);   
                }
            });
            new Resizeable(id, {minHeight: 20, minWidth: 20, resize: function(el) {
                height = $(id).getStyle('height');
                width = $(id).getStyle('width');
                new Ajax.Updater('log','items/updateItemSize/'+<?php echo $id ?>+'/'+height+'/'+width);
                }
            });
        </script>
        
        <?php
    }
?>
<div id='log'></div>
