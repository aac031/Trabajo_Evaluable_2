<?php
// Comprobamos la existencia de la sesión, si no existe lo enviamos a login.
session_start();
if (!isset($_SESSION['logueado']) || !$_SESSION['logueado']) {
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar contactos</title>
</head>

<body>
    <?php
    // Llamamos a las paginas que necesitaremos
    include "header.php";
    
    include "conexion.php";

    include "buscar_persona.php";

    include "buscar_empresa.php";
    ?>
</body>

</html>