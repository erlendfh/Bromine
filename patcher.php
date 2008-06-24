<?php
    //Use this file to create patches to the DB. Append your sql to the file and remember to write revision numbers.
    require('libs/DBHandler.php');
    $dbh = new DBHandler();
    
    //Revision 61
    $dbh->sql("
    ALTER TABLE `trm_projects` ADD `outsidedefects` TINYINT( 1 ) NOT NULL ,
    ADD `viewdefectsurl` VARCHAR( 256 ) NOT NULL ,
    ADD `adddefecturl` VARCHAR( 256 ) NOT NULL ;"
    );
    
    echo "If there was no errors above. It worked";
?>
