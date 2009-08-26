<?php
    if($output === true){
        echo "<h1>The plugin installed succesfully</h1>";
    }else{
        echo "<h1>There was an error</h1>";
        pr($output);
    }
?>      