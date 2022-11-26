<?php
// Comprobamos si la sesión está iniciada o no con isset.
session_start();
if (!isset($_SESSION['logueado']) || !$_SESSION['logueado']) {
    // Si la sesión no existe, tendremos que loguearnos.
} else {
    // Si la sesión ya está iniciada, nos redireccionará a "home.php".
    header("Location: home.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Login</title>
</head>
<!-- Iniciamos Sesión 
    Introduciremos usuario y contraseña, que serán enviados a "auth.php", donde
    se comprobará si existen en la base de datos o no. 
    Usuario= normaluser Password= usudwes
    Usuario= adminuser Password= admindwes -->

<body>
    <h1>Inicia sesión</h1>
    <hr>
    <form action="auth.php" method="POST">
        <br>
        <label for="usuario">Usuario: </label>
        <input type="text" name="usuario">
        <br><br>
        <label for="password">Contraseña: </label>
        <input type="password" name="password">
        <br><br>
        <input type="submit" name="envio" value="Acceder">
    </form>
</body>

</html>