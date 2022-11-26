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
    <title>Modificar contacto</title>
</head>

<body>
    <?php
    // Llamamos al header y lo mostramos
    include "header.php";
    // Nos conectamos a la base de datos
    include "conexion.php";
    ?>
    <hr>
    <?php
    // Comprobamos si se han enviado los datos
    if (isset($_POST['envio'])) {
        // Asignamos variables a los datos
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];

        // Realizamos la sentencia con los datos enviados y los modificamos con la siguiente sentencia
        $sql = "UPDATE contacto_persona SET nombre='" . $nombre . "', apellidos='" . $apellidos . "',
            direccion='" . $direccion . "', telefono='" . $telefono . "' where id='" . $id . "'";
        // Ejecutamos la sentencia
        $resultado = mysqli_query($conexion, $sql);
        // Si los datos han sido modificado enviamos un mensaje al usuario
        if ($resultado) {
            echo "<script language='JavaScript'>
                alert('El contacto fue modificado con éxito.');
                location.assign('modificar.php');
                </script>";
        } else {
            // Si no han sido modificados enviamos un mensaje de error
            echo "<script language='JavaScript'>
                alert('Hubo un error al modificar el contacto.');
                location.assign('modificar.php');
                </script>";
        }
        // Cerramos la conexion
        mysqli_close($conexion);
    } else {
        // Asignamos una variable a la id enviada en modificar_persona
        $id = $_GET['id'];
        // Sentencia para mostrar los datos del contacto según su id
        $sql = "SELECT * FROM contacto_persona WHERE id= '" . $id . "'";
        // Ejecutamos la sentencia
        $resultado = mysqli_query($conexion, $sql);

        // Devolvemos un array asociativo que son el resultado de la sentencia
        $fila = mysqli_fetch_assoc($resultado);
        // Le asignamos variables a los valores de cada campo de la tabla
        $nombre = $fila['nombre'];
        $apellidos = $fila['apellidos'];
        $direccion = $fila['direccion'];
        $telefono = $fila['telefono'];

        // Cerramos la conexion
        mysqli_close($conexion);
    ?>
        <h2>Modificar contacto: </h2>
        <br>
        <!-- Enviamos los datos a la misma pagina -->
        <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
            <label for="nombre">Nombre: </label>
            <input type="text" name="nombre" value="<?php echo $nombre; ?>">
            <br><br>
            <label for="apellidos">Apellidos: </label>
            <input type="text" name="apellidos" value="<?php echo $apellidos; ?>">
            <br><br>
            <label for="direccion">Dirección: </label>
            <input type="text" name="direccion" value="<?php echo $direccion; ?>">
            <br><br>
            <label for="telefono">Teléfono: </label>
            <input type="tel" name="telefono" value="<?php echo $telefono; ?>">
            <br><br>
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="envio" value="Modificar">
        </form>
    <?php
    }
    ?>
</body>

</html>