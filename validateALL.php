  <html>
  <head>
    <script type="text/javascript" src="js/prototype.js"></script>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <style>
      div{display:inline;}
    </style>
  </head>
  <body>
<?php
$path="/var/www/dev";
$i=0;
echo "<table>";
if ($handle = opendir($path)){
  while (false !== ($file = readdir($handle))) {
    if(!is_dir("$path/$file")){
      echo "<tr>";
      $i++;
      $files[]=current(explode('.',$file));
      $files2[]=$file;
      echo "<td>$file<td>";
      
      echo "<td><div id='xhtml$i'>xhtml</div> - <div id='css$i'>css</div></td>";
      if (strpos($file, 'save') === false && strpos($file, '.php') !== false && strpos($file, 'class') === false){
        $home = "http://".$_SERVER['SERVER_NAME'] ."/" .$file;
        echo "<script type='text/javascript'>";
          echo "new Ajax.Updater('xhtml$i', 'validate.php?type=xhtml&self=$home', { method: 'get' });";
          echo "new Ajax.Updater('css$i', 'validate.php?type=css&self=$home', { method: 'get' });";
        echo "</script>";
        echo "</tr>";
      }
    }
  }
  closedir($handle);
}

echo "</table>";
?>
</body>
</html>
