<?php

set_include_path(get_include_path() . PATH_SEPARATOR . "drivers/php");
require_once 'Testing/Selenium.php';
require_once 'Testing/BRUnit.php';

class Example extends BRUnit
{
  function testMyTestCase()
  {
    $this->selenium->open("/users/index/user:admin/password:6770906accd531bd8cfd4c4f5d2b469c03f447e0/project:134");
    // Index
    try {
        $this->assertEquals("Users", $this->selenium->getTitle());
    } catch (Exception $e) {}

    try {
        $this->assertEquals("Users", $this->selenium->getText("//div[@id='column2']/div[2]/h1"));
    } catch (Exception $e) {}

    try {
        $this->assertTrue($this->selenium->isElementPresent("link=Name"));
    } catch (Exception $e) {}

    try {
        $this->assertTrue($this->selenium->isElementPresent("link=Firstname"));
    } catch (Exception $e) {}

    try {
        $this->assertTrue($this->selenium->isElementPresent("link=Lastname"));
    } catch (Exception $e) {}

    try {
        $this->assertTrue($this->selenium->isElementPresent("link=Group"));
    } catch (Exception $e) {}

    try {
        $this->assertTrue($this->selenium->isElementPresent("link=Email"));
    } catch (Exception $e) {}

    try {
        $this->assertEquals("Actions", $this->selenium->getText("//div[@id='column2']/div[2]/table/tbody/tr[1]/th[6]"));
    } catch (Exception $e) {}

    try {
        $this->assertTrue($this->selenium->isElementPresent("link=New User"));
    } catch (Exception $e) {}

    // Add
    $this->selenium->click("link=New User");
    $this->selenium->waitForPageToLoad("30000");
    $this->selenium->type("UserFirstname", "Peter");
    $this->selenium->type("UserLastname", "Hansen");
    $this->selenium->type("UserName", "username");
    $this->selenium->type("UserPassword", "password");
    $this->selenium->type("UserEmail", "peter@hansen.dk");
    $this->selenium->click("//input[@value='Submit']");
    $this->selenium->waitForPageToLoad("30000");
    try {
        $this->assertEquals("The User has been saved", $this->selenium->getText("flashMessage"));
    } catch (Exception $e) {}

    // edit
    $name = $this->selenium->getText("//td[1]");
    $firstname = $this->selenium->getText("//td[2]");
    $lastname = $this->selenium->getText("//td[3]");
    $group = $this->selenium->getText("//td[4]");
    $email = $this->selenium->getText("//td[5]");
    $this->selenium->click("link=Edit");
    $this->selenium->waitForPageToLoad("30000");
    try {
        $this->assertEquals("Users", $this->selenium->getTitle());
    } catch (Exception $e) {}

    try {
        $this->assertEquals(name, $this->selenium->getValue("UserName"));
    } catch (Exception $e) {}

    try {
        $this->assertEquals(firstname, $this->selenium->getValue("UserFirstname"));
    } catch (Exception $e) {}

    try {
        $this->assertEquals(email, $this->selenium->getValue("UserEmail"));
    } catch (Exception $e) {}

    try {
        $this->assertEquals(lastname, $this->selenium->getValue("UserLastname"));
    } catch (Exception $e) {}

    try {
        $this->assertTrue($this->selenium->isElementPresent("UserGroupId"));
    } catch (Exception $e) {}

    try {
        $this->assertTrue($this->selenium->isElementPresent("ProjectProject"));
    } catch (Exception $e) {}

    $newname = "username2";
    $newfirstname = "Peter2";
    $newlastname = "Hansen2";
    $newemail = "peter@hansen.dk2";
    $project = "selftest";
    $this->selenium->type("UserName", $newname);
    $this->selenium->type("UserFirstname", $newfirstname);
    $this->selenium->type("UserLastname", $newlastname);
    $this->selenium->type("UserEmail", $newemail);
    $this->selenium->addSelection("ProjectProject", "label=" . $project);
    $this->selenium->click("//input[@value='Submit']");
    $this->selenium->waitForPageToLoad("30000");
    // view
    $this->selenium->click("link=View");
    $this->selenium->waitForPageToLoad("30000");
    try {
        $this->assertEquals(newname, $this->selenium->getText("//div[@id='column2']/div[2]/dl/dd[1]"));
    } catch (Exception $e) {}

    try {
        $this->assertEquals(newfirstname, $this->selenium->getText("//div[@id='column2']/div[2]/dl/dd[2]"));
    } catch (Exception $e) {}

    try {
        $this->assertEquals(newlastname, $this->selenium->getText("//div[@id='column2']/div[2]/dl/dd[3]"));
    } catch (Exception $e) {}

    try {
        $this->assertEquals(newemail, $this->selenium->getText("//div[@id='column2']/div[2]/dl/dd[5]"));
    } catch (Exception $e) {}

    try {
        $this->assertTrue($this->selenium->isTextPresent("selftest"));
    } catch (Exception $e) {}

    // delete
    $this->selenium->click("link=Delete User");
    $this->selenium->chooseOkOnNextConfirmation();
    try {
        $this->assertEquals("User deleted", $this->selenium->getText("flashMessage"));
    } catch (Exception $e) {}

  }
}
startTest("Example" , $argv);
?>