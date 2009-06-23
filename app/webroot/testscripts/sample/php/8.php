<?php

set_include_path(get_include_path() . PATH_SEPARATOR . "drivers/php");
require_once "Testing/Selenium.php";
require_once "Testing/BRUnit.php";

class BromineTest extends BRUnit{

  function testMyTestCase() 
  {
    $this->selenium->open("/");
/*
    $this->selenium->type("q", "hello world");
    $this->selenium->click("btnG");
    $this->selenium->waitForPageToLoad("30000");
    $this->selenium->click("link=Hello world program - Wikipedia, the free encyclopedia");
    $this->selenium->waitForPageToLoad("30000");
    $this->assertTrue($this->selenium->isTextPresent("Hello world program"));
    $this->assertFalse($this->selenium->isTextPresent("Hello world program"));
    $this->assertEquals("Hello world program", $this->selenium->getText("firstHeading"));
    $this->customCommand('TEST','passed','VAR1','VAR2');
    */
    
    $data = $this->selenium->captureScreenshotToString();
    //$data .= '==';
    echo $data . "\n";
    
    $data = base64_decode($data);
    
    
    //echo $data . "\n";
    
    $im = imagecreatefromstring($data );

    imagepng($im, 'C:/logs/test1.png');
    imagedestroy($im);

/*
$data = 'iVBORw0KGgoAAAANSUhEUgAAABwAAAASCAMAAAB/2U7WAAAABl'
       . 'BMVEUAAAD///+l2Z/dAAAASUlEQVR4XqWQUQoAIAxC2/0vXZDr'
       . 'EX4IJTRkb7lobNUStXsB0jIXIAMSsQnWlsV+wULF4Avk9fLq2r'
       . '8a5HSE35Q3eO2XP1A1wQkZSgETvDtKdQAAAABJRU5ErkJggg==';
$data = base64_decode($data);

$im = imagecreatefromstring($data);

    imagepng($im,'C:/logs/test.png');
    imagedestroy($im);
*/
  }
}
$argv[]
$argv[4] = 4444;
startTest('BromineTest' , $argv);


?>
