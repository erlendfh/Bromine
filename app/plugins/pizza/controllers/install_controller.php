<?php
class InstallController extends PizzaAppController {
    var $name = 'Install';
    
    function install(){
        //This is the place to dreate and populate whatever tables you need. Be carefull!
        //Bromine will create the relevant ACL entries for the plugin
        $sql1 = "
        CREATE TABLE 'table_name'
        ('column 1' 'data_type_for_column_1',
        'column 2' 'data_type_for_column_2')
        ";
        $sql2 = "
        INSERT INTO table_name (column1, column2, column3,...)
        VALUES ('value1', 'value2', 'value3')
        ";
        /*
        $this->Install->query($sql1);
        $this->Install->query($sql2);
        if(allwentwell){
            return true;
        }else{
            return error;
        }
        */
        return true; 
    }
    
    function uninstall(){
        //this is the place to remove whatever you inserted into the DB. Be carefull! 
        //Bromine will delete the folder containing the plugin and remove the ACL entries
        $sql = "DROP TABLE table_name1, table_name2";
        /*
        $this->Install->query($sql);
        if(allwentwell){
            return true;
        }else{
            return error;
        }
        */
        return true;
    }
     
}
?>