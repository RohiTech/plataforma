<!DOCTYPE html>
<html>
<head>
  <title>Principal</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script>
    function abrirVentanaConexion() {
      window.open("conexion.php", "Conexion", "width=400, height=300");
    }
  </script>
</head>
<body>
  <?php
    session_start();

    if (!isset($_SESSION['user_id'])) {
      header("Location: login.php");
      exit;
    }

    // Obtener datos del usuario
    $user_id = $_SESSION['user_id'];
    $nombre = $_SESSION['nombre'];
    $tipo_usuario = $_SESSION['tipo_usuario'];

    // Mostrar el contenido de la página principal
    echo "<div class='container mt-5'>";
    echo "<h2>Bienvenido, " . $nombre . "</h2>";

    if ($tipo_usuario === 'admin') {
      echo "<p>Eres administrador del sistema.</p>";
      echo "<a href='admin.php' class='btn btn-primary'>Administración</a>";

      // Panel de navegación con Bootstrap
      echo "<div class='mt-4'>";
      echo "<h3 class='mb-3'>Menú del Sistema</h3>";
      echo "<nav class='nav flex-column'>";
        echo "<a class='nav-link' href='usuarios.php'>Usuarios</a>";
        echo "<a class='nav-link' href='intentos_inicio_sesion.php'>Intentos de Inicio de Sesión</a>";
        echo "<a class='nav-link' href='sesiones.php'>Sesiones</a>";
        echo "<a class='nav-link' href='roles.php'>Roles</a>";
        echo "<a class='nav-link' href='roles_usuarios.php'>Roles de Usuarios</a>";
        echo "<a class='nav-link' href='permisos.php'>Permisos</a>";
        echo "<a class='nav-link' href='permisos_roles.php'>Permisos de Roles</a>";
        echo "<a class='nav-link' href='cursos.php'>Cursos</a>";
        echo "<a class='nav-link' href='secciones_curso.php'>Secciones del Curso</a>";
        echo "<a class='nav-link' href='lecciones.php'>Lecciones</a>";
        echo "<a class='nav-link' href='preguntas.php'>Preguntas</a>";
        echo "<a class='nav-link' href='respuestas.php'>Respuestas</a>";
        echo "<a class='nav-link' href='inscripciones.php'>Inscripciones</a>";
        echo "<a class='nav-link' href='progreso_alumno.php'>Progreso del Alumno</a>";
      echo "</nav>";
      echo "</div>";
    } elseif ($tipo_usuario === 'profesor') {
      echo "<p>Eres profesor.</p>";
      echo "<a href='profesor.php' class='btn btn-primary'>Panel de profesor</a>";
    } else {
      echo "<p>Eres alumno.</p>";
      echo "<a href='alumno.php' class='btn btn-primary'>Panel de alumno</a>";
    }

    echo "<br><br>";
    echo "<button class='btn btn-success' onclick='abrirVentanaConexion()'>Ver Conexión a la Base de Datos</button>";
    echo "<br><br>";
    echo "<a href='index.php' class='btn btn-danger'>Cerrar sesión</a>";
    echo "</div>";
  ?>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>