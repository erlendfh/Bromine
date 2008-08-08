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
    }catch(Exception $error){
        echo "Error: $error";
    }
    
    try{
        //Revision 67
        $dbh->updateDB("INSERT INTO TRM_lang VALUES ('','Filename must not be empty', 'Filename must not be empty','','Filnavn må ikke være blankt','')");     
    }catch(Exception $error){
        echo "Error: $error";
    }
    
    try{
        $dbh->updateDB("INSERT INTO TRM_lang VALUES ('', 'Upload file', 'Upload file', '', 'Upload fil', '')";
    }catch(Exception $error){
        echo "Error: $error";
    }
    
    try{
        //Revision 105
        $dbh->updateDB("INSERT INTO TRM_lang VALUES (, 'Stored in', 'Stored in', '', 'Gemt i','')";
        echo "Patching completed succesfully";  
    }catch(Exception $error){
        echo "Error: $error";
    }
    
?>
