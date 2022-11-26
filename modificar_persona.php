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
    <title>Modificar contacto</title>
</head>

<body>
    <?php
    // Nos conectamos a la base de datos
    include "conexion.php";
    // Con esta consulta mostraremos todos los contactos de personas que hayan en la base de datos.
    $sql = "SELECT * FROM contacto_persona";
    // Ejecutamos la sentencia
    $resultado = mysqli_query($conexion, $sql);
    ?>
    <!-- Creamos una tabla en la cual mostraremos todos los contactos con sus respectivos datos. -->
    <h2>Lista de Contactos de persona:</h2>
    <!-- A la tabla se le asignará una clase que afectará en su estilo. -->
    <table class="minimalistBlack">
        <thead>
            <!-- Le damos nombres a las columnas de la tabla. -->
            <tr>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            // En la tabla creada anteriormente, se mostrará siempre los datos que se encuentren en la base de datos.
            // Si no hay datos en la base simplemente estará vacía la tabla.
            while ($filas = mysqli_fetch_assoc($resultado)) {
            ?>
                <tr>
                    <!-- Dentro de la tabla meteremos todos los datos que nos muestre las consultas hechas en la linea 24. -->
                    <td><?php echo $filas['nombre'] ?></td>
                    <td><?php echo $filas['apellidos'] ?></td>
                    <td><?php echo $filas['direccion'] ?></td>
                    <td><?php echo $filas['telefono'] ?></td>
                    <td>
                        <!-- Cogemos la id de cada fila (contacto) de la tabla y con ese id realizaremos la sentencia para modificarlo -->
                        <?php echo "<a href='modificar_persona_2.php?id=" . $filas['id'] . "'>Modificar contacto</a>"; ?>
                    </td>
                </tr>
            <?php
                // Cerramos el bucle while.
            }
            ?>
    </table>
    <?php
    // Cerramos la conexion con la base de datos
    mysqli_close($conexion);
    ?>
</body>

</html>