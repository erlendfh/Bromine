<?php
    if($output === true){
        echo "<h1>The plugin uninstalled succesfully</h1>";
    }else{
        echo "<h1>There was an error</h1>";
        pr($output);
    }
?>      