<?php if(!empty($acos)): ?>
<style>
    #ACL td{
        background-color: #FF7B7B;
    }
    #ACL td.access{
        background-color: #AAFFAA;
        /*#DEF4DE*/
    }
    #ACL td.deny{
        background-color: #FF7B7B;
    }
</style>
<table id='ACL'>
<tr>
    <th>Resource</th>
    <th>Access</th>
    <th>Deny</th>
</tr>
<?php
    //pr($personal);
    //pr($inherited);
    foreach($acos as $aco){
        
        echo "<tr>";
        $everything_access = null;
        $access_checked = null;
        $deny_checked = null;
        $access_disabled = null;
        $deny_disabled = null;
        
        if(!empty($inherited) && array_key_exists($aco['Myaco']['alias'], $inherited)){
            if($inherited[$aco['Myaco']['alias']]['access']==1){
                $access_disabled = "DISABLED";
                $access_checked = "CHECKED";
                $everything_access = 'access';
            }else{
                $deny_disabled = "DISABLED";
                $deny_checked = "CHECKED";
                $everything_access = 'deny';
            }
        }
        if(!empty($personal) && array_key_exists($aco['Myaco']['alias'], $personal)){
            if($personal[$aco['Myaco']['alias']]['access']==1){
                $access_checked = "CHECKED";
                $everything_access = 'access';
            }else{
                $deny_checked = "CHECKED";
                $everything_access = 'deny';
            }
        }
        
        $alias = end(split('/',$aco['Myaco']['alias']));
        echo "<td class='$everything_access' style='font-size: 16px; font-weight: bold;'>$alias</td>";
        echo "<td class='$everything_access'>";
        echo "<input type='checkbox' $access_checked $access_disabled onclick='
            if(!this.checked){
                new Ajax.Request(".'"'."manage_acl/removeACL/$id/".$aco['Myaco']['id'].'"'.",{
                            asynchronous: false
                        });
                new Ajax.Updater(".'"'."permissions".'"'.",".'"'."manage_acl/listAcos/$id".'"'.");
            }else{
                new Ajax.Request(".'"'."manage_acl/createACL/$id/".$aco['Myaco']['id'].'/1"'.",{
                            asynchronous: false
                        });
                new Ajax.Updater(".'"'."permissions".'"'.",".'"'."manage_acl/listAcos/$id".'"'.");
            }
        '/>";
        echo "</td>";
        echo "<td class='$everything_access'>";
        echo "<input type='checkbox' $$deny_checked $deny_disabled onclick='
            if(!this.checked){
                new Ajax.Request(".'"'."manage_acl/removeACL/$id/".$aco['Myaco']['id'].'"'.",{
                            asynchronous: false
                        });
                new Ajax.Updater(".'"'."permissions".'"'.",".'"'."manage_acl/listAcos/$id".'"'.");
            }else{
                new Ajax.Request(".'"'."manage_acl/createACL/$id/".$aco['Myaco']['id'].'/1"'.",{
                            asynchronous: false
                        });
                new Ajax.Updater(".'"'."permissions".'"'.",".'"'."manage_acl/listAcos/$id".'"'.");
            }
        '/>";
        echo "</td>";
        foreach($aco['children'] as $controller){
            
            $controller_access = $everything_access;
            $access_checked = null;
            $deny_checked = null;
            $access_disabled = null;
            $deny_disabled = null;
            
            echo "<tr>";
            
            if(!empty($inherited) && array_key_exists($controller['Myaco']['alias'], $inherited)){
                if($inherited[$controller['Myaco']['alias']]['access']==1){
                    $access_disabled = "DISABLED";
                    $access_checked = "CHECKED";
                    $controller_access = 'access';
                }else{
                    $deny_disabled = "DISABLED";
                    $deny_checked = "CHECKED";
                    $controller_access = 'deny';
                }
            }
            if(!empty($personal) && array_key_exists($controller['Myaco']['alias'], $personal)){
                if($personal[$controller['Myaco']['alias']]['access']==1){
                    $access_checked = "CHECKED";
                    $controller_access = 'access';
                }else{
                    $deny_checked = "CHECKED";
                    $controller_access = 'deny';
                }
            }
            
            $alias = end(split('/',$controller['Myaco']['alias']));
            echo "<td class='$controller_access' style='padding-left: 20px; font-weight: bold;'>".$alias."</td>";
            echo "<td class='$controller_access'>";
            echo "<input type='checkbox' $access_checked $access_disabled onclick='
                if(!this.checked){
                    new Ajax.Request(".'"'."manage_acl/removeACL/$id/".$controller['Myaco']['id'].'"'.",{
                            asynchronous: false
                        });
                    new Ajax.Updater(".'"'."permissions".'"'.",".'"'."manage_acl/listAcos/$id".'"'.");
                }else{
                    new Ajax.Request(".'"'."manage_acl/createACL/$id/".$controller['Myaco']['id'].'/1"'.",{
                            asynchronous: false
                        });
                    new Ajax.Updater(".'"'."permissions".'"'.",".'"'."manage_acl/listAcos/$id".'"'.");
                }
            '/>";
            echo "</td>";
            echo "<td class='$controller_access'>";
            echo "<input type='checkbox' $deny_checked $deny_disabled onclick='
                if(!this.checked){
                    new Ajax.Request(".'"'."manage_acl/removeACL/$id/".$controller['Myaco']['id'].'"'.",{
                            asynchronous: false
                        });
                    new Ajax.Updater(".'"'."permissions".'"'.",".'"'."manage_acl/listAcos/$id".'"'.");
                }else{
                    new Ajax.Request(".'"'."manage_acl/createACL/$id/".$controller['Myaco']['id'].'/0"'.",{
                            asynchronous: false
                        });
                    new Ajax.Updater(".'"'."permissions".'"'.",".'"'."manage_acl/listAcos/$id".'"'.");
                }
            '/>";
            echo "</td>";
            foreach($controller['children'] as $action){
                $action_access = $controller_access;
                $access_checked = null;
                $deny_checked = null;
                $access_disabled = null;
                $deny_disabled = null;
                
                echo "<tr>";            
                if(!empty($inherited) && array_key_exists($action['Myaco']['alias'], $inherited)){
                    if($inherited[$action['Myaco']['alias']]['access']==1){
                        $access_disabled = "DISABLED";
                        $access_checked = "CHECKED";
                        $action_access = 'access';
                    }else{
                        $deny_disabled = "DISABLED";
                        $deny_checked = "CHECKED";
                        $action_access = 'deny';
                    }
                }
                if(!empty($personal) && array_key_exists($action['Myaco']['alias'], $personal)){
                    if($personal[$action['Myaco']['alias']]['access']==1){
                        $access_checked = "CHECKED";
                        $action_access = 'access';
                    }else{
                        $deny_checked = "CHECKED";
                        $action_access = 'deny';
                    }
                }
                
                
                $alias = end(split('/',$action['Myaco']['alias']));
                echo "<td class='$action_access' style='padding-left: 40px;'>".$alias."</td>";
                echo "<td class='$action_access'>";
                echo "<input type='checkbox' $access_checked $access_disabled onclick='
                    if(!this.checked){
                        new Ajax.Request(".'"'."manage_acl/removeACL/$id/".$action['Myaco']['id'].'"'.",{
                            asynchronous: false
                        });
                        new Ajax.Updater(".'"'."permissions".'"'.",".'"'."manage_acl/listAcos/$id".'"'.");
                    }else{
                        new Ajax.Request(".'"'."manage_acl/createACL/$id/".$action['Myaco']['id'].'/1"'.",{
                            asynchronous: false
                        });
                        new Ajax.Updater(".'"'."permissions".'"'.",".'"'."manage_acl/listAcos/$id".'"'.");
                    }
                '/>";
                echo "</td>";
                echo "<td class='$action_access'>";
                echo "<input type='checkbox' $deny_checked $deny_disabled onclick='
                    if(!this.checked){
                        new Ajax.Request(".'"'."manage_acl/removeACL/$id/".$action['Myaco']['id'].'"'.",{
                            asynchronous: false
                        });
                        new Ajax.Updater(".'"'."permissions".'"'.",".'"'."manage_acl/listAcos/$id".'"'.");
                    }else{
                        new Ajax.Request(".'"'."manage_acl/createACL/$id/".$action['Myaco']['id'].'/0"'.",{
                            asynchronous: false
                        });
                        new Ajax.Updater(".'"'."permissions".'"'.",".'"'."manage_acl/listAcos/$id".'"'.");
                    }
                '/>";
                echo "</td>";
                echo "</tr>";    
            }
            echo "</tr>";
        }
        echo "</tr>";
                  
    }
    echo "</ul>";
?>
<?php endif ?>
</table>