<?php
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
    <title>Modificar contactos</title>
</head>

<body>
    <?php
    include "header.php";
    include "conexion.php";
    ?>
    <hr>
    <h1>Modificar contacto: </h1>
    <?php
    include "modificar_persona.php";
    include "modificar_empresa.php";
    ?>
</body>

</html>