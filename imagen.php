<?php
// Comprobamos la existencia de la sesión, si no existe lo enviamos a login.
session_start();
if (!isset($_SESSION['logueado']) || !$_SESSION['logueado']) {
    header("Location: login.php");
}

// Comprobamos si se presiono el boton de subir archivo
if (isset($_POST['subir_usuario'])) {
    // Recibimos el archivo enviado por el usuario.
    $archivo = $_FILES['archivo']['name'];
    // Si el archivo recibido no está vacío.
    if (isset($archivo) && $archivo != "") {
        // Datos necesarios del archivo.
        $tipo = $_FILES['archivo']['type'];
        $tamano = $_FILES['archivo']['size'];
        $temp = $_FILES['archivo']['tmp_name'];
        // Comprobamos si el archivo subido es correcto, según su extensión y tamaño.
        if (!((strpos($tipo, "png") || strpos($tipo, "jpg") || strpos($tipo, "pdf")) && ($tamano <= 50000000))) {
            // Si el archivo no es correcto, el usuario observará un mensaje en pantalla.
            echo "<script language='JavaScript'>
                    alert('La extensión o tamaño de la imagen no es correcta.');
                    location.assign('imagen.php');
                    </script>";
        } else {
            // Si la imagen es correcta
            if (move_uploaded_file($temp, 'uploads/' . $archivo)) {
                // Mostramos el mensaje de que se ha subido co éxito
                echo "<script language='JavaScript'>
                    alert('Se ha subido la imagen correctamente.');
                    location.assign('imagen.php');
                    </script>";
            } else {
                // Si no se ha podido subir la imagen, mostramos un mensaje de error
                echo "<script language='JavaScript'>
                    alert('Hubo un error al subir la imagen.');
                    location.assign('imagen.php');
                    </script>";
            }
        }
    }
}

// Comprobamos si se presiono el boton de subir archivo
if (isset($_POST['subir_empresa'])) {
    // Recibimos el archivo enviado por el usuario.
    $archivo = $_FILES['archivo']['name'];
    // Si el archivo recibido no está vacío.
    if (isset($archivo) && $archivo != "") {
        // Datos necesarios del archivo.
        $tipo = $_FILES['archivo']['type'];
        $tamano = $_FILES['archivo']['size'];
        $temp = $_FILES['archivo']['tmp_name'];
        // Comprobamos si el archivo subido es correcto, según su extensión y tamaño.
        if (!((strpos($tipo, "png") || strpos($tipo, "jpg") || strpos($tipo, "pdf")) && ($tamano <= 50000000))) {
            // Si el archivo no es correcto, el usuario observará un mensaje en pantalla.
            echo "<script language='JavaScript'>
                    alert('La extensión o tamaño del logo no es correcto.');
                    location.assign('imagen.php');
                    </script>";
        } else {
            // Si la imagen es correcta
            if (move_uploaded_file($temp, 'uploads/' . $archivo)) {
                // Mostramos el mensaje de que se ha subido co éxito
                echo "<script language='JavaScript'>
                    alert('Se ha subido el logo correctamente.');
                    location.assign('imagen.php');
                    </script>";
            } else {
                // Si no se ha podido subir la imagen, mostramos un mensaje de error
                echo "<script language='JavaScript'>
                    alert('Hubo un error al subir el logo.');
                    location.assign('imagen.php');
                    </script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Subir imagen o logo</title>
</head>

<body>
    <?php
    // Llamamos a header y lo mostramos por pantalla.
    include "header.php";
    ?>
    <hr>
    <br>
    <!-- El usuario podrá subir una imagen o un logo. -->
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" method="POST">
        <label>Añadir imagen a usuario:</label>
        <input name="archivo" id="archivo" type="file">
        <input type="submit" name="subir_usuario" value="Subir imagen">
    </form>
    <br><br>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" method="POST">
        <label>Añadir logo a empresa:</label>
        <input name="archivo" id="archivo" type="file">
        <input type="submit" name="subir_empresa" value="Subir imagen">
    </form>
</body>

</html>