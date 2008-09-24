<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<?php
    //print_r($_SESSION);
    if (isset($_GET['errormsg'])) {
        $errormsg = $_GET['errormsg'];
        echo "
        <script type='text/javascript'>
            alert('$errormsg');
        </script>
        ";
    }

?>
  <script type="text/javascript" src="js/prototype.js"></script>
  
  <?php
echo "<title>Bromine v. 1.9 Beta</title>";
echo "<!-- 
  Copyright 2008 Rasmus Berg Palm, Peter Visti Kløft, Jeppe Poss Pedersen & Christian Nørlyng 
  http://bromine.openqa.org
  
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
?>
<link rel="icon" href="img/logo.png" type="image/x-icon" />
<link rel="shortcut icon" href="img/logo.png" type="image/x-icon" />
