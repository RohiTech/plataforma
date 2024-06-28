<!DOCTYPE html>
<html>
<head>
  <title>Panel de Administración</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <?php
    session_start();

    // Verificar si el usuario es administrador
    if (!isset($_SESSION['user_id']) || $_SESSION['tipo_usuario'] !== 'admin') {
      header("Location: principal.php");
      exit;
    }

    // Obtener datos del usuario
    $nombre = $_SESSION['nombre'];

    echo "<div class='container mt-5'>";
    echo "<h2>Panel de Administración</h2>";
    echo "<p>Bienvenido, " . $nombre . "</p>";

    // Contenido del panel de administración
    // Aquí puedes agregar las opciones del administrador, por ejemplo:
    // - Gestión de usuarios
    // - Gestión de contenido
    // - Estadísticas
    echo "<p>Aquí puedes implementar las funciones del administrador.</p>";

    echo "<a href='principal.php' class='btn btn-primary'>Volver a Principal</a>";
    echo "</div>";
  ?>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>