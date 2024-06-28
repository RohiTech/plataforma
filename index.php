<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h4>Login</h4>
          </div>
          <div class="card-body">
            <?php
              if (isset($_POST['submit'])) {
                $email = $_POST['email'];
                $password = $_POST['password'];

                // Conexión a la base de datos
				$servername = "localhost";
                $username = "root";
                $passwordDB = "unicenta*";
                $dbname = "plataforma";

                $conn = new mysqli($servername, $username, $passwordDB, $dbname);
				
                if ($conn->connect_error) {
                  die("Conexión fallida: " . $conn->connect_error);
                }

                // Consulta para validar el usuario
                $sql = "SELECT * FROM Users WHERE email = '$email'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  $row = $result->fetch_assoc();
                  
                  // Verificar la contraseña
                  //if (password_verify($password, $row['password'])) {
                    session_start();
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['nombre'] = $row['nombre'];
                    $_SESSION['tipo_usuario'] = $row['tipo_usuario'];
                    header("Location: principal.php");
                    exit;
                  //} else {
                    //echo "<div class='alert alert-danger'>Contraseña incorrecta.</div>";
                  //}

                } else {
                  echo "<div class='alert alert-danger'>Usuario no encontrado.</div>";
                }

                $conn->close();
              }
            ?>
            <form method="POST" action="">
              <div class="form-group">
                <label for="email">Correo electrónico:</label>
                <input type="email" class="form-control" id="email" name="email" required>
              </div>
              <div class="form-group">
                <label for="password">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
              </div>
              <button type="submit" name="submit" class="btn btn-primary">Iniciar sesión</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>