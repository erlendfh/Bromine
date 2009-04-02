<?php
    foreach($testcases as $testcase){
        echo "<div id='".$testcase['Testcase']['id']."' style='clear: both;' class='tc'>";
        echo "<span class='spacer'></span>";
        $link = $ajax->remoteFunction(
                        array(
                            'url'=>array( 'controller' => 'testcases', 'action' => 'view', $testcase['Testcase']['id']), 
                            'update' => 'Main'
                        )
                    );
                    
        echo $html->link($testcase['Testcase']['name'],'#',array('onclick'=>$link));
        echo "<a href='#' class='del' onclick='removetc(this.up(".'"div"'."), this.up(".'"li"'."));'><img src='/img/tango/16x16/places/user-trash.png'></img></a>";
        echo "</div>";
        ?>

        <script type='text/javascript'>
            new Draggable(<?php echo "'". $testcase['Testcase']['id']."'"; ?>, {
                ghosting: true,
                revert: true
            });
        </script>
        <?php
    }
    ?>

