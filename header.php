<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
  //print_r($_SESSION);
  if(isset($_GET['errormsg'])){
    $errormsg=$_GET['errormsg'];
    echo "<SCRIPT type='text/javascript'>
            alert('$errormsg')
          </SCRIPT>
    ";
  }
  
  $lite_result= $dbh->select('TRM_config','WHERE var="lite_version"','value');
  if (mysql_result($lite_result, 0, 'value') == "1"){

    $lite = 1;
  }
  
  ?>
  <script type="text/javascript" src="js/curPage.js"></script>
  <script type="text/javascript" src="js/prototype.js"></script>
  <script type="text/javascript">
    //window.onload=setTimeout("highLightCurPage()",100);
  </script>
  <script type="text/javascript">
  <!--
    function validate(){
      val_links="<div style='margin-top: 10px;'><div id='xhtml' style='display: inline'><a href='http://validator.w3.org/check/referer' title='Check the validity of this site&#8217;s XHTML'>xhtml</a></div>&nbsp;<div id='css' style='display: inline'><a href='http://jigsaw.w3.org/css-validator/check/referer' title='Check the validity of this site&#8217;s CSS'>css</a></div></div>";
      document.body.innerHTML=document.body.innerHTML+val_links;
      <?php if(!$w3){ ?>
        new Ajax.Updater('xhtml', 'validate.php?type=xhtml', { method: 'get' })
        new Ajax.Updater('css', 'validate.php?type=css', { method: 'get' })
      <?php } ?>
    }
    //window.onload=setTimeout("validate()",400);
    -->
  </script>
  
  <?php
  echo "<title>Bromine v. 1.9 Beta</title>";
  echo "<!-- 
  Copyright 2008 Rasmus Berg Palm, Peter Visti Kløft, Jeppe Poss Pedersen & Christian Nørlyng 
  http://www.assembla.com/wiki/show/Bromine
  
  This file is part of Bromine.

  Bromine is free software: you can redistribute it and/or modify
  it under the terms of the GNU General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  Bromine is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with Bromine.  If not, see <http://www.gnu.org/licenses/>.
   -->";
if (isset($_GET['error'])){echo "<h2 style='color: red;'>".$_GET['error']."</h2>";}
?>
<link rel="icon" href="img/logo.png" type="image/x-icon" />
<link rel="shortcut icon" href="img/logo.png" type="image/x-icon" />
