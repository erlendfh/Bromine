<?php include ('protected.php'); ?>
<?php
  //print_r($GLOBALS['_POST']);
    
    $u_id=$_POST['u_id'];
    $name=$_POST['name'];
    $firstname=$_POST['firstname'];
    $lastname=$_POST['lastname'];
    $password=$_POST['password'];
    $ut_id=$_POST['ut_id'];
    $email=$_POST['email'];
    
    $newname=$_POST['newname'];
    $newfirstname=$_POST['newfirstname'];
    $newlastname=$_POST['newlastname'];
    $newpassword=$_POST['newpassword'];
    $newut_id=$_POST['newut_id'];
    $newemail=$_POST['newemail'];

    $dbh= new DBHandler();
    
    //USERS UPDATER
    for($i=0;$i<count($u_id);$i++){
      $dbh->update('TRM_users',
      "name = '$name[$i]',
       firstname='$firstname[$i]',
       lastname='$lastname[$i]',
       password='$password[$i]',
       usertype='$ut_id[$i]',
       email='$email[$i]'",
       "ID = '$u_id[$i]'");
    }
    //USER INSERTER
    if((strlen($newname) > 0 && strlen($newpassword)== 0) || (strlen($newname) == 0 && strlen($newpassword) > 0)){
      $error = "?usrPwd=".$lh->getText("Username")." ".$lh->getText("and")." ".$lh->getText("Password")." ".$lh->getText("must not be empty");
    }
    if(strlen($newname)>0 && strlen($newpassword)>0){
      $result = $dbh->select("TRM_users", 'WHERE name = "'.$newname.'"', "name");
      $num = mysql_num_rows($result);
      if($num != 0){
        $error = "?c_user=".$newname;
      }
      else{
        $newu_id=$dbh->insert('TRM_users',
        "NULL,
        '$newname',
        '$newfirstname',
        '$newlastname',
        '$newpassword',
        '$newut_id',
        '$newemail'",
        'ID,
        name,
        firstname,
        lastname,
        password,
        usertype,
        email');
        
        $result = $dbh->select('TRM_projects','','*');
        $num = mysql_num_rows($result);
        for($i=0;$i<$num;$i++){
          $p_id = mysql_result($result,$i,"id");
          $dbh->insert('TRM_projectList',
          "NULL,
          '$newu_id',
          '$p_id',
          '0'",
          'ID,
          userID,
          projectID,
          access');
        }
      }
    }
    
  header ("Location: editUsers.php".$error."#$newu_id");
  
?>
