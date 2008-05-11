<?php include ('protected.php'); ?>
<?php
  
  //print_r($GLOBALS['_POST']);
  /*
  Array
(
    [n_id] => Array
        (
            [0] => 15
            [1] => 11
            [2] => 17
        )

    [nodepath] => Array
        (
            [0] => 10.0.0.18
            [1] => 10.0.0.12
            [2] => 10.0.0.12
        )

    [ftp_login] => Array
        (
            [0] => test
            [1] => test
            [2] => devtest
        )

    [ftp_pass] => Array
        (
            [0] => Not24Get
            [1] => Not24Get
            [2] => Not24Get
        )

    [OS] => Array
        (
            [0] => 12
            [1] => 1
            [2] => 1
        )

    [description] => Array
        (
            [0] => XP node
            [1] => Vista node
            [2] => Dev Miljø
        )

    [browsers] => Array
        (
            [15] => Array
                (
                    [0] => 1
                    [1] => 3
                    [2] => 11
                    [3] => 10
                )

            [11] => Array
                (
                    [0] => 1
                    [1] => 3
                    [2] => 10
                )

            [17] => Array
                (
                    [0] => 1
                    [1] => 3
                    [2] => 10
                )

        )

    [browser_path] => Array
        (
            [15] => Array
                (
                    [1] => *iehta
                    [3] => *firefox
                    [10] => *chrome
                )

            [11] => Array
                (
                    [1] => *iehta
                    [3] => *firefox
                    [10] => *chrome
                )

            [17] => Array
                (
                    [1] => *iehta
                    [3] => *firefox
                    [10] => *chrome
                )

        )

    [type] => Array
        (
            [15] => Array
                (
                    [0] => 1
                )

            [11] => Array
                (
                    [0] => 1
                    [1] => 2
                )

            [17] => Array
                (
                    [0] => 1
                )

        )

    [test_path] => Array
        (
            [15] => Array
                (
                    [1] => rc-php
                )

            [11] => Array
                (
                    [1] => rc-php
                )

            [17] => Array
                (
                    [1] => dev/rc-php
                )

        )

    [newpath] => 
    [newftp_login] => 
    [newftp_pass] => 
    [newOS] => 1
    [newdescription] => 
)
*/
 

    $n_id=$_POST['n_id'];
    $nodepath=$_POST['nodepath'];
    $OS=$_POST['OS'];
    $description=$_POST['description'];
    $network_drive=$_POST['network_drive'];
    
    $browsers=$_POST['browsers'];
    $browser_path=$_POST['browser_path'];
    //$type=$_POST['type'];
    //$test_path=$_POST['test_path'];
    
    $newpath=$_POST['newpath'];
    $newOS=$_POST['newOS'];
    $newdescription=$_POST['newdescription'];
    $newbrowsers=$_POST['newbrowsers'];
    //$newtypes=$_POST['newtypes'];
    $newnetworkdrive=$_POST['newnetwork_drive'];

   

    //NODES UPDATER
    for($i=0;$i<count($n_id);$i++){
      $dbh->update('TRM_nodes',
      "nodepath = '$nodepath[$i]',
      o_id = '$OS[$i]',
      description = '$description[$i]',
      network_drive = '$network_drive[$i]'",
      "ID = '$n_id[$i]'");
    }
    
    //BROWSERS UPDATER (Deletes everything and reinserts new definitions)
    if($n_id!=''){
      mysql_query("TRUNCATE TABLE TRM_nodes_browsers");
      for($i=0;$i<count($n_id);$i++){
        $n_idc=$n_id[$i];
        for($u=0;$u<count($browsers[$n_idc]);$u++){
          $b_id=$browsers[$n_idc][$u];
          $browser_pathc=$browser_path[$n_idc][$b_id];  
          $dbh->insert('TRM_nodes_browsers',
          "'',
          '$b_id',
          '$n_idc',
          '$browser_pathc'",
          'ID,
          b_id,
          n_id,
          browser_path');
        }
      }
    }
    
    
    //NODE INSERTER
    if(strlen($newpath)>0){
      $newn_id=$dbh->insert('TRM_nodes',
      "'',
      '$newpath',
      '$newOS',
      '$newdescription',
      '$newnetworkdrive'",
      'ID,
       nodepath,
       o_id,
       description,
       network_drive');
       
    for($i=0;$i<count($newbrowsers);$i++){ //INSERTS THE BROWSERS
        $b_id=$newbrowsers[$i];
        $dbh->insert('TRM_nodes_browsers',
        "'',
        '$b_id',
        '$newn_id',
        ''",
        'ID,
         b_id,
         n_id,
         browser_path');
       }
       
    }
  $goto = $n_id[count($n_id)-1];
  header ("Location: editNodes.php#$goto");
  
?>
