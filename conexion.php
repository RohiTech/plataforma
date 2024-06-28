<?php
// Define las credenciales de la base de datos
$servername = "localhost";
$username = "root";
$password = "unicenta*";
$dbname = "plataforma";

// Crea la conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica si la conexión fue exitosa
if ($conn->connect_error) {
  die("Conexión fallida: " . $conn->connect_error);
}

// Ahora puedes usar la conexión $conn para realizar consultas a la base de datos
// Ejemplo:
$sql = "SELECT * FROM usuarios";
$result = $conn->query($sql);

// ... tu lógica para procesar los resultados
?>