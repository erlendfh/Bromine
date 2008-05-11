Welcome. Hope this Readme will help a bit.

To install Bromine upload the folder Bromine1.53 to your website. Rename if it you want.
Open http://yourwebsite.com/Bromine1.53/install.php
Fill out the forms. (Host is usually "localhost")
Press install.
If everything works, you should get "Install complete"
Delete install.php and sql.sql from the Bromine folder.
Login and behold the wonders.

Bromine works (as of now) with 2 tools:
Selenium core &
Selenium RC

Selenium core is simple: Upload your tests to the server you are testing and add them to the Bromine system
Then run the tests from core testrunner

Selenium RC is a bit harder. You'll need to setup one or more nodes to run the tests.
See RCFramework/readme.txt for info on how to do this.
Add the note under edit nodes in the admin module:
Add a type path for the node (where you placed the RCFramework (rc-php in our example))
Add a ftp user for the node. Important! this user has to have the folder above the type path as his root!
If you've set up the folder structure as described in RCFramework/readme.txt you should be able to see node suites
under testlab -> edit tests.
If this don't work, you've probably made a mistake in setting up either the correct folder structure on the php server OR the wrong type path under admin->edit nodes. 
editTest.php looks in all <nodepath>/<typepath>/<projectname>/suites for suite files and lists them.

Add the tests and run them under testlab->noderunner

Now with bromine and your nodes installed (yeah right) install the IDE extension to make test creation easy.
