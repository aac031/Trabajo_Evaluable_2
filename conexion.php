<?php
// Establecemos conexión con la base de datos 'agenda'.
// Siempre que tengamos que hacer una consulta, modificación o eliminación 
// de un dato de la base de datos tendremos que realizar esta conexión.
$dbname = "agenda";
$dbuser = "root";
$dbhost = "localhost";
$dbpass = "";

$conexion = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
