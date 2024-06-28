<?php
  // Incluir el archivo de configuración
  require_once 'config.php';

  // Obtener datos del formulario
  $nombre = $_POST['nombre'];
  $email = $_POST['email'];
  $contrasena = $_POST['contrasena'];
  $tipoUsuario = $_POST['tipoUsuario'];

  // Hashear la contraseña
  $contrasena_hasheada = password_hash($contrasena, PASSWORD_DEFAULT);

  // Insertar usuario en la base de datos
  $sql = "INSERT INTO Usuarios (nombre, email, contrasena, tipo_usuario) 
          VALUES ('$nombre', '$email', '$contrasena_hasheada', '$tipoUsuario')";

  if ($conn->query($sql) === TRUE) {
    echo "Usuario agregado correctamente.";
  } else {
    echo "Error al agregar usuario: " . $conn->error;
  }

  // Cerrar la conexión a la base de datos
  $conn->close();
?>