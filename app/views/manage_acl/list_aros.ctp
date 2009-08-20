<?php
    if(!empty($CurrentAros)){
       echo "<h3 style='display: inline;'>".$CurrentAros['Myaro']['alias']."</h3>";
       echo "<br />";
    } 
    if(!empty($CurrentAros)){
        echo $html->link('..','#',array('onclick'=>
        "
          new Ajax.Updater('aros','manage_acl/listAros/".$CurrentAros['Myaro']['parent_id']."', {
                evalScripts: true
            });
          new Ajax.Updater('permissions','manage_acl/listAcos/".$CurrentAros['Myaro']['parent_id']."', {
                evalScripts: true
            });  
        "        
        ));
        echo "<br />";
    }
    foreach($Aros as $Aro){
        $id = $Aro['Myaro']['id'];
        echo $html->link(end(split('/',$Aro['Myaro']['alias'])),'#',array('onclick'=>
        "
            new Ajax.Updater('aros','manage_acl/listAros/$id', {
                evalScripts: true
            });
          new Ajax.Updater('permissions','manage_acl/listAcos/$id');  
        "        
        ));
        echo "<br />";
    }
?>
