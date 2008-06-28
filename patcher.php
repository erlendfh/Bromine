<?php
    //Use this file to create patches to the DB. Append your sql to the file and remember to write revision numbers.
    require('libs/DBHandler.php');
    $dbh = new DBHandler();
    
    try{
        //Revision 61
        $dbh->sql("
        ALTER TABLE `trm_projects` ADD `outsidedefects` TINYINT( 1 ) NOT NULL ,
        ADD `viewdefectsurl` VARCHAR( 256 ) NOT NULL ,
        ADD `adddefecturl` VARCHAR( 256 ) NOT NULL ;"
        );
        
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
        //Revision 67
        $dbh->sql("INSERT INTO trm_lang VALUES ('','Filename must not be empty', 'Filename must not be empty','','Filnavn må ikke være blankt','')");
        echo "Patching completed succesfully";
        
    }catch(Exception $error){
        echo "Error: $error";
    }
    
?>
