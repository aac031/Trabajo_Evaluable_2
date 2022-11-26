<?php
// Comprobamos la existencia de la sesión, si no existe lo enviamos a login.
session_start();
if (!isset($_SESSION['logueado']) || !$_SESSION['logueado']) {
    header("Location: login.php");
} else {
    include "conexion.php";
    
    // Si existe la tabla contacto_persona la eliminamos. 
    $sql_drop_persona = "DROP TABLE IF EXISTS `contacto_persona`";
    // Ejecutamos la sentencia.
    $drop_persona = mysqli_query($conexion, $sql_drop_persona);
    // Si existe la tabla contacto_empresa la eliminamos.
    $sql_drop_empresa = "DROP TABLE IF EXISTS `contacto_empresa`";
    // Ejecutamos la sentencia.
    $drop_empresa = mysqli_query($conexion, $sql_drop_empresa);

    // Eliminamos la sesión 'logueado' y redireccionamos a 'login' 
    unset($_SESSION['logueado']);
    header("Location: login.php");
}
