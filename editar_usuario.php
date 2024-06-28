<!DOCTYPE html>
<html>
<head>
  <title>Editar Usuario</title>
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

      // Procesar la actualización si se envía el formulario
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Obtener los datos del formulario
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $tipo_usuario = $_POST['tipo_usuario'];

        // Actualizar la información del usuario en la base de datos
        $sql = "UPDATE users SET nombre = :nombre, email = :email, tipo_usuario = :tipo_usuario WHERE user_id = :user_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':tipo_usuario', $tipo_usuario);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        // Redireccionar a la ventana de usuarios
        header("Location: usuarios.php");
        exit;
      }

      // Mostrar el formulario de edición
      echo "<div class='container mt-5'>";
      echo "<h2>Editar Usuario</h2>";
      echo "<form method='post' action=''>";
      echo "<div class='form-group'>";
      echo "<label for='nombre'>Nombre:</label>";
      echo "<input type='text' class='form-control' id='nombre' name='nombre' value='" . $usuario['nombre'] . "'>";
      echo "</div>";
      echo "<div class='form-group'>";
      echo "<label for='email'>Correo electrónico:</label>";
      echo "<input type='email' class='form-control' id='email' name='email' value='" . $usuario['email'] . "'>";
      echo "</div>";
      echo "<div class='form-group'>";
      echo "<label for='tipo_usuario'>Tipo de usuario:</label>";
      echo "<select class='form-control' id='tipo_usuario' name='tipo_usuario'>";
      echo "<option value='admin'" . ($usuario['tipo_usuario'] === 'admin' ? ' selected' : '') . ">Administrador</option>";
      echo "<option value='profesor'" . ($usuario['tipo_usuario'] === 'profesor' ? ' selected' : '') . ">Profesor</option>";
      echo "<option value='alumno'" . ($usuario['tipo_usuario'] === 'alumno' ? ' selected' : '') . ">Alumno</option>";
      echo "</select>";
      echo "</div>";
      echo "<button type='submit' class='btn btn-primary'>Guardar cambios</button>";
      echo "</form>";
      echo "</div>";
    } catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
  ?>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>