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
    <link rel="stylesheet" href="css/estilos.css">
    <title>Crear contacto de persona</title>
</head>

<body>
    <?php
    // Llamamos al header y lo mostramos por pantalla
    include "header.php";
    ?>
    <hr>
    <?php
    // Comprobamos si se ha enviado la información
    if (isset($_POST['envio'])) {
        // Asignamos variables a cada dato enviado
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];

        // Conectamos con la base de datos
        include("conexion.php");
        // Realizamos la consulta de inserción de datos en la tabla contacto_persona
        $sql = "INSERT INTO contacto_persona(nombre, apellidos, direccion, telefono)
        VALUES('" . $nombre . "', '" . $apellidos . "', '" . $direccion . "', '" . $telefono . "')";

        // Ejecutamos la sentencia
        $resultado = mysqli_query($conexion, $sql);

        // Comprobamos el resultado, si se realiza la inserción mostramos un mensaje de exito
        if ($resultado) {
            echo "<script language='JavaScript'>
            alert('El contacto de persona fue agregado con éxito.');
            location.assign('home.php');
            </script>";
        } else {
            // Si no se inserta los datos igualmente mostramos un mensaje de error al usuario
            echo "<script language='JavaScript'>
            alert('Hubo un error al agregar el contacto.');
            location.assign('crear_persona.php');
            </script>";
        }
        // Cerramos la conexion con la base de datos
        mysqli_close($conexion);
    }
    ?>
    <h1>Añadir contacto de persona: </h1>
    <!-- Enviamos los datos a la misma pagina -->
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <label for="nombre">Nombre: </label>
        <input type="text" name="nombre" required>
        <br><br>
        <label for="apellidos">Apellidos: </label>
        <input type="text" name="apellidos">
        <br><br>
        <label for="direccion">Dirección: </label>
        <input type="text" name="direccion">
        <br><br>
        <label for="telefono">Teléfono: </label>
        <input type="tel" name="telefono">
        <br><br>
        <input type="submit" name="envio" value="Enviar">
    </form>
</body>

</html>