<?php

     $this->selenium->deleteCookie('PhoneBook',"domain=.$strippedURL");
     $this->assertFalse($this->selenium->isCookiePresent('PhoneBook'));
     $this->selenium->click($this->uimap['menu']['person tab']);
     $this->selenium->waitForPageToLoad($this->uimap['selenium']['timeout']);
     $this->selenium->type($this->uimap['person header']['person what'], $this->datamap['person name2']);
     $this->selenium->click($this->uimap['person header']['submit']);
     $this->selenium->waitForPageToLoad($this->uimap['selenium']['timeout']);
     $this->selenium->click($this->uimap['person result page']['add contact hit 1']);

?>
