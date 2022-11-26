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
    <title>Eliminar contactos</title>
</head>

<body>
    <?php
    // Llamamos al header y lo mostramos por pantalla
    include "header.php";
    ?>
    <?php
    // Comprobamos si hemos recibido el id de la fila (contacto)
    if (isset($_GET['id'])) {
        // Le asignamos una variable a lo recibido
        $id = $_GET['id'];
        // Nos conectamos a la base de datos
        include "conexion.php";

        // Eliminamos al contacto por su id con la siguiente sentencia
        $sql = "DELETE FROM contacto_empresa WHERE id='" . $id . "'";
        // Ejecutamos la sentencia
        $resultado = mysqli_query($conexion, $sql);

        // Si la id es correcta se eliminará de la base de datos
        // se muestra un mensaje al usuario, y si no lo elimina también muestra un mensaje
        if ($resultado) {
            echo "<script language='JavaScript'>
                alert('El contacto de empresa fue eliminado con éxito.');
                </script>";
        } else {
            echo "<script language='JavaScript'>
                alert('Hubo un error al eliminar el contacto.');
                </script>";
        }
        // Cerramos la conexion con la base de datos
        mysqli_close($conexion);
    }
    ?>
    <hr>
    <h1>Eliminar contactos: </h1>
    <?php
    // Nos conectamos a la base de datos
    include "conexion.php";
    // Con esta consulta mostraremos todos los contactos de empresas que hayan en la base de datos.
    $sql = "SELECT * FROM contacto_empresa";
    // Ejecutamos la sentencia
    $resultado = mysqli_query($conexion, $sql);
    ?>
    <!-- Creamos una tabla en la cual mostraremos todos los contactos con sus respectivos datos. -->
    <h2>Lista de Contactos de empresa:</h2>
    <!-- A la tabla se le asignará una clase que afectará en su estilo. -->
    <table class="minimalistBlack">
        <thead>
            <!-- Le damos nombres a las columnas de la tabla. -->
            <tr>
                <th>Nombre</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th>Email</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            // En la tabla creada anteriormente, se mostrará siempre los datos que se encuentren en la base de datos.
            // Si no hay datos, en la base simplemente estará vacía la tabla.
            while ($filas = mysqli_fetch_assoc($resultado)) {
            ?>
                <tr>
                    <!-- Dentro de la tabla meteremos todos los datos que nos muestre la consulta hecha en la linea 52. -->
                    <td><?php echo $filas['nombre'] ?></td>
                    <td><?php echo $filas['direccion'] ?></td>
                    <td><?php echo $filas['telefono'] ?></td>
                    <td><?php echo $filas['email'] ?></td>
                    <td>
                        <!-- Cogemos la id de cada fila (contacto) de la tabla y con ese id realizaremos la sentencia para eliminarlo de la base de datos -->
                        <?php echo "<a href='eliminar_empresa.php?id=" . $filas['id'] . "'>Eliminar contacto</a>"; ?>
                    </td>
                </tr>
            <?php
                // Cerramos el bucle while.
            }
            ?>
        </tbody>
    </table>
    <?php
    // Cerramos la conexion con la base de datos
    mysqli_close($conexion);
    ?>
</body>

</html>