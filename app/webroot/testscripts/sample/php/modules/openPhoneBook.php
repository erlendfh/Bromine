<?php
$this->selenium->click($this->uimap['person result page']['my contactlist link']);
     $this->selenium->waitForPopUp($this->uimap['person result page']['addressbook'], $this->uimap['selenium']['timeout']);
     $this->selenium->selectWindow($this->uimap['person result page']['popup window']);
     for ($second = 0; ; $second++) {
              if ($second >= 15) $this->fail("timeout");
              try {
                       if ($this->selenium->isElementPresent($this->uimap['person result page']['addressbook-wrap'])) break;
                       else $this->waiting();
              } catch (Exception $e) {}
              sleep(1);
     }
     
?>
