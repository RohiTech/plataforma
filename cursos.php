<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cursos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Cursos</h2>

        <a href="crear_curso.php" class="btn btn-primary mb-3">Agregar Curso</a>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Categoría</th>
                    <th>Profesor</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Incluimos el archivo de conexión a la base de datos
                require_once 'conexion.php';

                // Consulta para obtener todos los cursos
                $sql = "SELECT * FROM Courses";
                $result = $conn->query($sql);

                // Iteramos sobre los resultados y mostramos los cursos en la tabla
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["curso_id"] . "</td>";
                        echo "<td>" . $row["nombre"] . "</td>";
                        echo "<td>" . $row["descripcion"] . "</td>";
                        echo "<td>" . $row["categoria"] . "</td>";
                        echo "<td>" . $row["profesor_id"] . "</td>"; // Deberías mostrar el nombre del profesor, no solo su ID
                        echo "<td>" . $row["precio"] . "</td>";
                        echo "<td>";
                        echo "<a href='editar_curso.php?curso_id=" . $row["curso_id"] . "' class='btn btn-warning'>Editar</a>";
                        echo "<a href='eliminar_curso.php?curso_id=" . $row["curso_id"] . "' class='btn btn-danger'>Eliminar</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No hay cursos disponibles.</td></tr>";
                }

                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>