<?php
    echo " i = $this->i\n";
    $hit = sprintf($this->uimap['person result page']['add contact hit x'], $this->i);
    echo $hit;
    $this->selenium->click($hit);
         for ($second = 0; ; $second++) {
                  if ($second >= 15) $this->fail("timeout");
                  try {
                            if ($this->selenium->isElementPresent($this->uimap['person result page']['contact form'])) break;
                            else $this->waiting();
                  } catch (Exception $e) {}
                  sleep(1);
         }
    
         $this->selenium->click($this->uimap['person result page']['add button']);
         for ($second = 0; ; $second++) {
                  if ($second >= 15) $this->fail("timeout");
                  try {
                            if ($this->selenium->isTextPresent($this->uimap['person result page']['confirm text'])) break;
                            else $this->waiting();
                  } catch (Exception $e) {}
                  sleep(1);
         }
    
         $this->selenium->click($this->uimap['person result page']['close link']);
    

?>
