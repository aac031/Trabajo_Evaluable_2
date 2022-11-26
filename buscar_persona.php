<?php
// Comprobamos la existencia de la sesión, si no existe lo enviamos a login.
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
    <title>Buscar contactos</title>
</head>

<body>
    <?php
    // Realizamos la conexion con la base de datos.
    include "conexion.php";
    ?>
    <hr>
    <!-- El contacto introducira el nombre del contacto que desea buscar en la base de datos. -->
    <h1>Buscar contacto de persona: </h1>
    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
        <label>Nombre de persona: </label>
        <input type="text" name="nombre">
        <input type="submit" name="envio1" value="Buscar">
    </form>
    <br>
    <!-- Creamos una tabla en la cual mostraremos todos los contactos con sus respectivos datos. -->
    <!-- A la tabla se le asignará una clase que afectará en su estilo. -->
    <h2>Lista de contactos de personas:</h2>
    <table class="minimalistBlack">
        <thead>
            <!-- Le damos nombres a las columnas de la tabla. -->
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Direccion</th>
                <th>Telefono</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Comprobamos si se recibe el nombre
            if (isset($_POST['envio1'])) {
                // Si recibimos el nombre le asignamos una variable
                $nombre = $_POST['nombre'];

                // Si el nombre está vacío se le mostrará un mensaje al usuario
                if (empty($_POST['nombre'])) {
                    echo "<script language='JavaScript'>
                    alert('Introduce el nombre para la búsqueda.');
                    location.assign('buscar.php');
                    </script>";
                } else {
                    // Si no está vacío realizaremos la consulta
                    $sql = "SELECT * FROM contacto_persona WHERE nombre like '%" . $nombre . "%'";
                }
                // Ejecutamos la consulta
                $resultado = mysqli_query($conexion, $sql);

                // Si se ejecuta la consulta y no muestra ningún dato, mostrará un mensaje al usuario
                if (mysqli_num_rows($resultado) == 0) {
                    echo "<script language='JavaScript'>
                    alert('El nombre no existe en la base de datos.');
                    location.assign('buscar.php');
                    </script>";
                }
                // En la tabla creada anteriormente, se mostrará siempre los datos que se encuentren en la base de datos.
                // Si no hay datos, en la base simplemente estará vacía la tabla.
                while ($filas = mysqli_fetch_assoc($resultado)) {
            ?>
                    <tr>
                        <!-- Dentro de la tabla meteremos todos los datos que nos muestre las consultas hecha en la linea 60. -->
                        <td><?php echo $filas['nombre'] ?></td>
                        <td><?php echo $filas['apellidos'] ?></td>
                        <td><?php echo $filas['direccion'] ?></td>
                        <td><?php echo $filas['telefono'] ?></td>
                    </tr>
                <?php
                    // Cerramos el bucle while
                }
                // Si no ha sido enviado el nombre para realizar la busqueda, se mostrarán solo los nombres de los contactos
                // para facilitar la busqueda al usuario.    
            } else {
                // Realizamos la consulta que muestra todos los nombres de los contactos
                $sql = "SELECT * FROM contacto_persona";
                // Ejecutamos la consulta
                $resultado = mysqli_query($conexion, $sql);
                // En la tabla creada anteriormente, se mostrará siempre los datos que se encuentren en la base de datos.
                // Si no hay datos, en la base simplemente estará vacía la tabla.
                while ($filas = mysqli_fetch_assoc($resultado)) {
                ?>
                    <tr>
                        <!-- Dentro de la tabla meteremos todos los datos que nos muestre las consultas hecha en la linea 89. -->
                        <td><?php echo $filas['nombre'] ?></td>
                    </tr>
            <?php
                    // Cerramos el bucle while
                }
                // Cerramos el else 
            }
            ?>
        </tbody>
    </table>
    <?php
    // Cerramos la conexion con la base de datos.
    mysqli_close($conexion);
    ?>
</body>

</html>