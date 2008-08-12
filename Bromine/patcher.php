<?php
    /**
     * Use this file to create patches to the DB. Append your sql to the file and remember to write revision numbers.
     * 
     * Use the updateDB($sql) function in the dbhandler to avoid the function call die().
     */               
    
    require('libs/DBHandler.php');
    $dbh = new DBHandler();
    
    try{
        //Revision 61
        $dbh->updateDB("
        ALTER TABLE `TRM_projects` ADD `outsidedefects` TINYINT( 1 ) NOT NULL ,
        ADD `viewdefectsurl` VARCHAR( 256 ) NOT NULL ,
        ADD `adddefecturl` VARCHAR( 256 ) NOT NULL ;"
        );
    echo "Patching to revision 61 (Adds external defect system) completed succesfully<br />";
    }catch(Exception $error){
        echo "Error: $error<br />";
    }
    
    try{    
        //Revision 64 - Updates your user passwords to md5 hashes.
        $user_pass_result = $dbh->select('TRM_users', "", "*");
        while ($row = mysql_fetch_array($user_pass_result)) {
            $pass = $row['password'];
            $id = $row['id'];
            if(strlen($pass)!=32){ //Probably not md5
                $pass=md5($pass);
                $dbh->update('TRM_users', "password='$pass'", "id='$id'");
            }
        }
        echo "Patching to revision 64 (Updates your user passwords to md5 hashes) completed succesfully<br />";   
    }catch(Exception $error){
        echo "Error: $error";
    }
    
    try{
        //Revision 67
        $dbh->updateDB("INSERT INTO TRM_lang VALUES (NULL,'Filename must not be empty', 'Filename must not be empty','','Filnavn må ikke være blankt','')");
          echo "Patching to revision 67 completed succesfully (1 of 2)<br />";   
    }catch(Exception $error){
        echo "Error: $error";
    }
    
    try{
        $dbh->updateDB("INSERT INTO TRM_lang VALUES (NULL, 'Upload file', 'Upload file', '', 'Upload fil', '')";
        echo "Patching to revision 67 completed succesfully (2 of 2)<br />";   
    }catch(Exception $error){
        echo "Error: $error";
    }
    
    try{
        //Revision 105
        $dbh->updateDB("INSERT INTO TRM_lang VALUES (NULL, 'Stored in', 'Stored in', '', 'Gemt i','')";
        echo "Patching to revision 105 completed succesfully<br />"; 
    }catch(Exception $error){
        echo "Error: $error";
    }
    
    try{
        //Revision fucking awesome universal runner
        $dbh->updateDB("CREATE TABLE IF NOT EXISTS `trm_selenium_server_vars` ( `sessionId` varchar(255) NOT NULL, `nodepath` varchar(255) NOT NULL, `u_id` varchar(255) NOT NULL, `t_id` int(11) NOT NULL, PRIMARY KEY  (`sessionId`) )";
        $dbh->updateDB("DROP TABLE IF EXISTS `trm_types`");
        $dbh->updateDB("CREATE TABLE IF NOT EXISTS `trm_types` (
        `ID` int(11) NOT NULL auto_increment,
        `typename` varchar(255) collate utf8_bin NOT NULL,
        `command` varchar(255) collate utf8_bin NOT NULL,
        `spacer` varchar(255) collate utf8_bin NOT NULL,
        `extension` varchar(255) collate utf8_bin NOT NULL,
        PRIMARY KEY  (`ID`)
        ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=11");
        $dbh->updateDB("INSERT INTO `trm_types` (`ID`, `typename`, `command`, `spacer`, `extension`) VALUES
        (1, 'rc-php', 'php', ' ', 'php'),
        (4, 'rc-java', 'java -jar', ' ', 'jar'),
        (10, 'rc-ruby', 'ruby', ' ', 'rb')");

        echo "Patching to awesome universal runner completed succesfully<br />";  
    }catch(Exception $error){
        echo "Error: $error";
    }
    echo "Done patching.";
    
?>
