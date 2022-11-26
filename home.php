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
    <title>Home</title>
</head>

<body>
    <?php
    // Llamamos a header
    include "header.php";
    ?>
    <hr>
    <!-- Le damos la bienvenida al usuario -->
    <h1>Bienvenido: </h1>
    <!-- El usuario podrá importar contactos de personas ya existentes en el archivo XML. -->
    <form action="importar_persona.php" method="POST">
        <label for="usuario">Importar contactos de personas: </label>
        <input type="submit" name="importar" value="Importar">
    </form>
    <br><br>
    <!-- El usuario podrá importar contactos de empresas ya existentes en el archivo XML. -->
    <form action="importar_empresa.php" method="POST">
        <label for="usuario">Importar contactos de empresas: </label>
        <input type="submit" name="importar" value="Importar">
    </form>

    <?php
    // Llamamos a "conexion.php"
    include "conexion.php";
    // Con esta consulta mostraremos todos los contactos de personas que hayan en la base de datos
    $sql = "SELECT * FROM contacto_persona";
    // Ejecutamos la sentencia
    $resultado = mysqli_query($conexion, $sql);

    // Con esta consulta mostraremos todos los contactos de empresas que hayan en la base de datos
    $sql = "SELECT * FROM contacto_empresa";
    // Ejecutamos la sentencia.
    $resultado2 = mysqli_query($conexion, $sql);
    ?>
    <!-- Creamos una tabla en la cual mostraremos todos los contactos con sus respectivos datos. -->
    <h2>Lista de contactos de personas:</h2>
    <!-- A la tabla se le asignará una clase que afectará en su estilo. -->
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
            // En la tabla creada anteriormente, se mostrará siempre los datos que se encuentren en la base de datos.
            // Si no hay datos en la base simplemente estará vacía la tabla.
            while ($filas = mysqli_fetch_assoc($resultado)) {
            ?>
                <tr>
                    <!-- Dentro de la tabla meteremos todos los datos que nos muestre las consultas hechas en la linea 44. -->
                    <td><?php echo $filas['nombre'] ?></td>
                    <td><?php echo $filas['apellidos'] ?></td>
                    <td><?php echo $filas['direccion'] ?></td>
                    <td><?php echo $filas['telefono'] ?></td>
                </tr>
            <?php
            // Cerramos el bucle while
            }
            ?>
        </tbody>
    </table>
    <br>
    <hr>
    <!-- Creamos una tabla en la cual mostraremos todos los contactos con sus respectivos datos. -->
    <h2>Lista de contactos de empresas:</h2>
    <!-- A la tabla se le asignará una clase que afectará en su estilo. -->
    <table class="minimalistBlack">
        <thead>
            <!-- Le damos nombres a las columnas de la tabla. -->
            <tr>
                <th>Nombre</th>
                <th>Direccion</th>
                <th>Telefono</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // En la tabla creada anteriormente, se mostrará siempre los datos que se encuentren en la base de datos.
            // Si no hay datos, en la base simplemente estará vacía la tabla.
            while ($filas = mysqli_fetch_assoc($resultado2)) {
            ?>
                <tr>
                    <!-- Dentro de la tabla meteremos todos los datos que nos muestre las consultas hechas en la linea 49. -->
                    <td><?php echo $filas['nombre'] ?></td>
                    <td><?php echo $filas['direccion'] ?></td>
                    <td><?php echo $filas['telefono'] ?></td>
                    <td><?php echo $filas['email'] ?></td>
                </tr>
            <?php
            // Cerramos el bucle while.
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