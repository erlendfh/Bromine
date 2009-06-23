<?php
    $this->i=1;   
    while($this->i <= 25){
        echo "a = $this->i";
        $this->loadModule('addContact');
        $this->i++;
    }
?>
