<?php


define("HOSTNAME", "db681492601.db.1and1.com");// Nombre del host
define("DATABASE", "db681492601"); // Nombre de la base de datos
define("USERNAME", "dbo681492601"); // Nombre del usuario
define("PASSWORD", "americano18"); // constraseña
 
 $con = mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE) or die('Unable to Connect');

 
?>
