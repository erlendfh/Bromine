<?php
    foreach($testcases as $testcase){
        $id = $testcase['Testcase']['id'];
        echo "<div id='$id' style='clear: both;' class='tc'>";
        echo "<span class='spacer'></span>";
       
        $fullname = $testcase['Testcase']['name'];
        $name = (strlen($fullname)>20 ? substr($fullname,0,20).'...' : $fullname);
        echo $ajax->link(
                $name, 
                array( 'controller' => 'testcases', 'action' => 'view', $testcase['Testcase']['id']), 
                array( 'update' => 'Main', 'title'=>$fullname)
            );
        echo "</div>";
        ?>
            <script type='text/javascript'>
                new Draggable("<?php echo $id ?>",{ //make it dragable
                        scroll: window,
                        ghosting: true,
                        revert: true
                    });
            </script>
        <?php
        
    }
?>
