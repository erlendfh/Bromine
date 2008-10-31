<?php include ('protected.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
<!-- TinyMCE -->
<script type="text/javascript" src="../tmr/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example word content CSS (should be your site CSS) this one removes paragraph margins
		content_css : "css/word.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>

<!-- /TinyMCE -->


        <?php include ('header.php'); ?>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
        <?php 
            require 'menu.php';
            BromineSubmenu::renderProjectsSubmenu();
                            
            $result = $dbh->select('trm_projects', 'WHERE trm_projects.ID!=1 ORDER BY name', '*');
            $num = mysql_num_rows($result);
            if (array_key_exists('which', $_GET)) {
                $which=$_GET['which'];
            }
        ?> 
        <form action='saveProjects.php' method='post'>
            <input type='hidden' id='which' name='which' value='<?php echo $which; ?>' />  
            <?php
                for ($i = 0;$i < $num;$i++) {
                    $p_id = mysql_result($result, $i, "id");
                    $name = mysql_result($result, $i, "name");
                    $description = mysql_result($result, $i, "description");
                    $assigned = mysql_result($result, $i, "assigned");
                    $outsidedefects = mysql_result($result, $i, "outsidedefects");
                    $viewdefectsurl = mysql_result($result, $i, "viewdefectsurl");
                    $adddefecturl = mysql_result($result, $i, "adddefecturl");

                    echo "<fieldset style='width: 768px;' id='fs$name'>";
                    echo '<legend style="cursor: pointer; font-weight: bold;" onclick="'."$('$name').toggle(); $(which).value='$name'".'">'.$name.'</legend>';
                    echo "<div id='$name' style='display:none;'>"; 
                    echo "<table>";
                    echo "<tr>";
                    echo "<td>".$lh->getText('Delete project')."</td>";
                    $confirm = '"' . $lh->getText('confirmDelete') . '"';
                    echo "<td align='left'><a href='delete.php?type=project&amp;id=$p_id&amp;back=editProjects.php' onclick='return confirm($confirm)' ><img src='img/trashcan.gif' alt='" . $lh->getText('Delete') . "' /></a></td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>".$lh->getText('Name')."</td>";
                    echo "<td align='left' id='$p_id'><input type='hidden' name='p_id[]' value='$p_id' /><input type='text' name='name[]' value='$name' /></td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>".$lh->getText('Description')."</td>";
                    echo "<td align='left'><textarea cols='80' rows='8' name='description[]' >$description</textarea></td>";
                    echo "<td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>".$lh->getText('Assigned to')."</td>";
                    echo "<td>";
                    echo "<select name=assigned[]>";
                    $user_result = $dbh->select('trm_users', 'ORDER BY name', "*");
                    $num_users = mysql_num_rows($user_result);
                    echo "<option value=''>" . $lh->getText('Choose') . "</option>";
                    for ($x = 0;$x < $num_users;$x++) {
                        $user_id = mysql_result($user_result, $x, 'id');
                        $user_name = mysql_result($user_result, $x, 'name');
                        if ($user_id == $assigned) {
                            echo "<option value='$user_id' selected='selected'>$user_name</option>";
                        } else {
                            echo "<option value='$user_id'>$user_name</option>";
                        }
                    }
                    echo "</select>";
                    echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>".$lh->getText('Sites to test')."</td>";
                    $result2 = $dbh->select('trm_projects_has_sites', "WHERE trm_projects_has_sites.p_id=$p_id ORDER BY sitetotest", '*');
                    $num2 = mysql_num_rows($result2);
                    echo "<td>";
                    for ($u = 0;$u < $num2;$u++) {
                        $ps_id = mysql_result($result2, $u, "id");
                        $sitetotest = mysql_result($result2, $u, "sitetotest");
                        echo "<input type='text' name='sitetotest[$ps_id]' value='$sitetotest' size='30'/>";
                        echo "<a href='delete.php?type=projects_has_sites&amp;id=$ps_id&amp;back=editProjects.php' onclick='return confirm($confirm)' ><img src='img/trashcan.gif' alt='" . $lh->getText('Delete') . "' /></a><br />";
                    }
                    echo $lh->getText('Add new');
                    echo "<br />";
                    echo "<input type='text' name='sitetotestnew[$p_id]' size='30' />";
                    echo "</td>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>".$lh->getText('Use external issue tracker')."</td>";
                    echo "<td>";
                    echo "<select name='outsidedefects[]'>";
                    echo "<option value='1' ".($outsidedefects == 1 ? "selected='selected'":'')." >".$lh->getText('Yes')."</option>";
                    echo "<option value='0' ".($outsidedefects == 0 ? "selected='selected'":'')." >".$lh->getText('No')."</option>";
                    echo "</select>";
                    if($outsidedefects){
                        echo "<table>";
                        echo "<tr><td>".$lh->getText('show defects url')."</td>";
                        echo "<td><input type='text' name='viewdefectsurl[]' value='$viewdefectsurl' size='25' /></td></tr>";
                        echo "<tr><td>".$lh->getText('add defect url')."</td>";
                        echo "<td><input type='text' name='adddefecturl[]' value='$adddefecturl' size='25' /></td></tr>";
                        echo "</table>";
                    }
                    echo "</td>";
                    echo "</tr>";
                    echo "</table>";
                echo "</div>";
                echo "</fieldset>";
                }
                
            ?> 
            <fieldset style='width: 768px;'>
            <legend style="cursor: pointer; font-weight: bold;" onclick="$('addnew').toggle()"><?php echo $lh->getText('Add project') ?></legend>
            <div id="addnew" style='display: none;'>
                <table>
                    <tr>
                        <?php echo "<td>" . $lh->getText('Name') . "</td>"; ?>
                        <td align='left'>
                            <input type='hidden' name='newp_id' />
                            <input type='text' name='newname' />
                        </td>
                    </tr>
                    <tr>
                        <?php echo "<td>" . $lh->getText('Description') . "</td>"; ?>
                        <td align='left'>
                            <textarea cols='80' rows='8' name='newdescription'></textarea></td>
                        <td >
                    </tr>
                    <tr>
                        <?php echo "<td>" . $lh->getText('Assigned to') . "</td>"; ?>
                        <td>
                            <select name='newassigned'>
                                <?php
                                    echo "<option value=''>" . $lh->getText('Choose') . "</option>";
                                    for ($x = 0;$x < $num_users;$x++) {
                                        $user_id = mysql_result($user_result, $x, 'id');
                                        $user_name = mysql_result($user_result, $x, 'name');
                                        echo "<option value='$user_id'>$user_name</option>";
                                    } 
                                ?>
                            </select>
                        </td> 
                    </tr>
                </table>
            </div>
            </fieldset>
            <div>
                <input type='submit' value='<?php echo $lh->
                getText('Submit'); ?>' />
            </div>
        </form>
        <?php
            if (array_key_exists('which', $_GET)) {
                echo "<script type='text/javascript'>$('$which').toggle();</script>";
            }
        ?> 
    </body>
</html>
