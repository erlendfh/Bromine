<?php
$this->selenium->deleteCookie('PhoneBook',"domain=.$this->strippedURL");
     $this->assertFalse($this->selenium->isCookiePresent('PhoneBook'));
     ?>
