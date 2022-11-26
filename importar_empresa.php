<?php
// Comprobamos la existencia de la sesión, si no existe lo enviamos a login.
// Si la conexion existe, llamamos a 'conexion' y accedemos al fichero XML.
session_start();
if (!isset($_SESSION['logueado']) || !$_SESSION['logueado']) {
    header("Location: login.php");
} else {
    require "conexion.php";
    // Interpretaremos el xml.
    $xml = simplexml_load_file("bd/agenda.xml");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Contactos importados</title>
</head>

<body>
    <?php
    // Llamamos a header y lo mostramos por pantalla.
    include "header.php";
    ?>
    <hr>
    <h2>Los contactos han sido importados con éxito. </h2>
    <br>
    <?php
    // Para la tabla contacto_empresa, solo serán importados los datos de los contactos
    // que tengan como atributo tipo empresa.
    foreach ($xml->contacto as $datos) {
        // Identificaremos el atributo del elemento.
        $atributo = $datos->attributes();
        // Si el atributo tipo es igual a empresa, los datos se introducirán en la tabla contacto_empresa
        if ($atributo['tipo'] == 'empresa') {
            echo "DATO IMPORTADO: <br>";
            echo "Nombre: " . $datos->nombre . "<br>";
            echo "Apellidos: " . $datos->direccion . "<br>";
            echo "Direccion: " . $datos->telefono . "<br>";
            echo "Email: " . $datos->email . "<br>";
            echo "<br>";
            // Sentencia para insertar los datos importados a la tabla contacto_empresa.
            $sql = "INSERT INTO contacto_empresa VALUES('', '$datos->nombre', '$datos->direccion', '$datos->direccion', '$datos->email')";
            // Ejecutamos la sentencia.
            $resultado = mysqli_query($conexion, $sql);
        }
    }
    // Si los datos importados son correctamente insertados en la tabla contacto_empresa,
    // se muestra un mensaje al usuario, y si no los importa también muestra un mensaje.
    if ($resultado) {
        echo "<script language='JavaScript'>
            alert('Contactos importados correctamente.');
            </script>";
    } else {
        echo "<script language='JavaScript'>
            alert('No se han podido importar los datos, son erróneos.');
            location.assign('home.php');
            </script>";
    }
    // Cerramos la conexion con la base de datos.
    mysqli_close($conexion);
    ?>
    <br><br>
    <form action="home.php" method="POST">
        <input type="submit" name="voler" value="Volver">
    </form>
</body>

</html>