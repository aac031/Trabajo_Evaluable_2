<?php
// Llamaremos a 'conexion.php' para realizar todas las consultas sql, 
// en 'conexion.php' realizaremos la conexion con la base de datos.
include 'conexion.php';
session_start();
// Comprobamos si los datos de usuario y password han sido introducidos
// anteriormente y se han enviado al servidor.
if (isset($_POST['usuario']) && isset($_POST['password'])) {
  // Le asignamos una variable a cada dato enviado.
  $usuario = $_POST['usuario'];
  $password = $_POST['password'];

  // Esta sentencia comprobará si el usuario está en la base de datos.
  $sql = "SELECT * FROM credenciales WHERE usuario = '" . $usuario . "'";

  // Con la funcion "mysqli_query" ejecutaremos la sentencia en la base de datos.
  $resultado = mysqli_query($conexion, $sql);

  // Obtendremos una fila de resultado como un array asociativo.
  $fila = mysqli_fetch_assoc($resultado);

  $passwordCifrada = $fila['password'];

  // Comprobamos que la contraseña introducida coincida con la contraseña cifrada que
  // está en la base de datos.
  if (password_verify($password, $passwordCifrada)) {
    // Si las contraseñas coinciden creamos una sesión.
    $_SESSION['logueado'] = true;

    // Sentencias creacion tabla para contactos de personas.
    // Si existe la tabla contacto_persona la eliminamos. 
    $sql_drop_persona = "DROP TABLE IF EXISTS `contacto_persona`";
    // Ejecutamos la sentencia.
    $drop_persona = mysqli_query($conexion, $sql_drop_persona);

    // Creamos la tabla contacto_persona.
    $sql_create_persona = "CREATE TABLE IF NOT EXISTS `contacto_persona` (
          `id` int(200) NOT NULL,
          `nombre` varchar(200) NOT NULL,
          `apellidos` varchar(200) NOT NULL,
          `direccion` varchar(200) NOT NULL,
          `telefono` varchar(200) NOT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    // Ejecutamos la sentencia.
    $create_persona = mysqli_query($conexion, $sql_create_persona);

    // La id de cada contacto será una clave primaria.
    $sql_alter_persona = "ALTER TABLE `contacto_persona`
      ADD PRIMARY KEY (`id`)";
    // Ejecutamos la sentencia.
    $alter_persona = mysqli_query($conexion, $sql_alter_persona);

    // La id será autoincremental, para que cuando se importe y/o cree otro contacto,
    // la id se incrementará siempre que se añada un contacto a la base de datos.
    $sql_modify_persona = "ALTER TABLE `contacto_persona`
      MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1";
    // Ejecutamos la sentencia.
    $modify_persona = mysqli_query($conexion, $sql_modify_persona);

    // Sentencias creacion tabla para contactos de empresas
    // Si existe la tabla contacto_empresa la eliminamos.
    $sql_drop_empresa = "DROP TABLE IF EXISTS `contacto_empresa`";
    // Ejecutamos la sentencia.
    $drop_empresa = mysqli_query($conexion, $sql_drop_empresa);

    // Creamos la tabla contacto_persona.
    $sql_create_empresa = " CREATE TABLE IF NOT EXISTS `contacto_empresa` (
        `id` int(200) NOT NULL,
        `nombre` varchar(200) NOT NULL,
        `direccion` varchar(200) NOT NULL,
        `telefono` varchar(200) NOT NULL,
        `email` varchar(200) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4";
    // Ejecutamos la sentencia.
    $create_empresa = mysqli_query($conexion, $sql_create_empresa);

    // La id de cada contacto será una clave primaria.
    $sql_alter_empresa = "ALTER TABLE `contacto_empresa`
      ADD PRIMARY KEY (`id`)";
    // Ejecutamos la sentencia.
    $alter_empresa = mysqli_query($conexion, $sql_alter_empresa);

    // La id será autoincremental, para que cuando se importe y/o cree otro contacto,
    // la id se incrementará siempre que se añada un contacto a la base de datos.
    $sql_modify_empresa = "ALTER TABLE `contacto_empresa`
      MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1";
    // Ejecutamos la sentencia.
    $modify_empresa = mysqli_query($conexion, $sql_modify_empresa);

    // Mostramos un mensaje al usuario diciendole que el logueo ha sido correcto.
    echo "<script language='JavaScript'>
      alert('Permiso concedido...');
      location.assign('home.php');
      </script>";
  } else {
    // Si el logueo es incorrecto, se lo diremos al usuario con un mensaje.
    // Y volverá a 'login'.
    $_SESSION['logueado'] = false;
    echo "<script language='JavaScript'>
      alert('Usuario o Password erróneos...');
      location.assign('login.php');
      </script>";
  }
} else {
  header("Location: login.php");
}
