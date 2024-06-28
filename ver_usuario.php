<?php
session_start();

// Verificar si el usuario es administrador
if (!isset($_SESSION['user_id']) || $_SESSION['tipo_usuario'] !== 'admin') {
  header("Location: principal.php");
  exit;
}

// Conexión a la base de datos (reemplaza con tus datos)
$servername = "localhost";
$username = "root";
$password = "unicenta*";
$dbname = "plataforma";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  // Obtener el ID del usuario desde la URL
  $user_id = $_GET['id'];

  // Consulta para obtener la información del usuario
  $sql = "SELECT * FROM users WHERE user_id = :user_id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':user_id', $user_id);
  $stmt->execute();
  $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

  // Mostrar la información del usuario
  echo "<div class='container mt-5'>";
  echo "<h2>Información del usuario</h2>";
  echo "<p><strong>Nombre:</strong> " . $usuario['nombre'] . "</p>";
  echo "<p><strong>Correo electrónico:</strong> " . $usuario['email'] . "</p>";
  echo "<p><strong>Tipo de usuario:</strong> " . $usuario['tipo_usuario'] . "</p>";
  echo "</div>";
} catch(PDOException $e) {
  echo "Error: " . $e->getMessage();
}
?>