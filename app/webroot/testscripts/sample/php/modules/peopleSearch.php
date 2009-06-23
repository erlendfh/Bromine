<?php

     
     $this->selenium->click($this->uimap['menu']['person tab']);
     $this->selenium->waitForPageToLoad($this->uimap['selenium']['timeout']);
     $this->selenium->type($this->uimap['person header']['person what'], $this->datamap['person name'][1]);
     $this->selenium->click($this->uimap['person header']['submit']);
     $this->selenium->waitForPageToLoad($this->uimap['selenium']['timeout']);
     

?>
