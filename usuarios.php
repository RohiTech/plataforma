<!DOCTYPE html>
<html>
<head>
  <title>Ventana de Usuarios</title>
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

      // Obtener la página actual
      $pagina_actual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;

      // Número de usuarios por página
      $usuarios_por_pagina = 10;

      // Calcular el inicio y el final del rango de usuarios
      $inicio = ($pagina_actual - 1) * $usuarios_por_pagina;
      $fin = $inicio + $usuarios_por_pagina;

      // Consulta para obtener el total de usuarios
      $sql_total = "SELECT COUNT(*) AS total FROM users";
      $stmt_total = $conn->prepare($sql_total);
      $stmt_total->execute();
      $total_usuarios = $stmt_total->fetch(PDO::FETCH_ASSOC)['total'];

      // Consulta para obtener los usuarios paginados
      $sql = "SELECT * FROM users LIMIT :inicio, :fin";
      $stmt = $conn->prepare($sql);
      $stmt->bindParam(':inicio', $inicio, PDO::PARAM_INT);
      $stmt->bindParam(':fin', $fin, PDO::PARAM_INT);
      $stmt->execute();
      $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

      // Mostrar la tabla de usuarios
      echo "<div class='container mt-5'>";
      echo "<h2>Usuarios</h2>";
      echo "<table class='table table-striped'>";
      echo "<thead>";
      echo "<tr>";
      echo "<th>ID</th>";
      echo "<th>Nombre</th>";
      echo "<th>Correo electrónico</th>";
      echo "<th>Tipo de usuario</th>";
      echo "<th>Acciones</th>";
      echo "</tr>";
      echo "</thead>";
      echo "<tbody>";

      foreach ($usuarios as $usuario) {
        echo "<tr>";
        echo "<td>" . $usuario['user_id'] . "</td>";
        echo "<td>" . $usuario['nombre'] . "</td>";
        echo "<td>" . $usuario['email'] . "</td>";
        echo "<td>" . $usuario['tipo_usuario'] . "</td>";
        echo "<td>";
          // Botones CRUD
          echo "<a href='ver_usuario.php?id=" . $usuario['user_id'] . "' class='btn btn-primary btn-sm'>Ver</a>";
          echo "<a href='editar_usuario.php?id=" . $usuario['user_id'] . "' class='btn btn-success btn-sm'>Editar</a>";
          echo "<a href='eliminar_usuario.php?id=" . $usuario['user_id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"¿Estás seguro de que deseas eliminar este usuario?\")'>Eliminar</a>";
        echo "</td>";
        echo "</tr>";
      }

      echo "</tbody>";
      echo "</table>";

      // Paginación
      echo "<nav aria-label='Page navigation'>";
      echo "<ul class='pagination'>";

      // Botón anterior
      if ($pagina_actual > 1) {
        echo "<li class='page-item'><a class='page-link' href='?pagina=" . ($pagina_actual - 1) . "' aria-label='Previous'><span aria-hidden='true'>«</span><span class='sr-only'>Anterior</span></a></li>";
      }

      // Números de páginas
      $total_paginas = ceil($total_usuarios / $usuarios_por_pagina);
      for ($i = 1; $i <= $total_paginas; $i++) {
        echo "<li class='page-item" . ($pagina_actual == $i ? ' active' : '') . "'><a class='page-link' href='?pagina=" . $i . "'>" . $i . "</a></li>";
      }

      // Botón siguiente
      if ($pagina_actual < $total_paginas) {
        echo "<li class='page-item'><a class='page-link' href='?pagina=" . ($pagina_actual + 1) . "' aria-label='Next'><span aria-hidden='true'>»</span><span class='sr-only'>Siguiente</span></a></li>";
      }

      echo "</ul>";
      echo "</nav>";

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