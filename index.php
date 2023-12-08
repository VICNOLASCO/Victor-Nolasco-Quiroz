<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Personas</title>
</head>
<style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #4caf50;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #4caf50;
            color: #fff;
        }

        tr:hover {
            background-color: #f2f2f2;
        }

        a {
            text-decoration: none;
            color: #3498db;
            transition: color 0.3s;
        }

        a:hover {
            color: #2980b9;
        }
    </style>
</head>

<body>
    <h1>Registro de Personas</h1>
    <form action="guardar.php" method="post">
        <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required><br>

<label for="edad">Edad:</label>
<input type="number" id="edad" name="edad" required><br>

<label for="correo">Correo:</label>
<input type="email" id="correo" name="correo" required><br>


        <input type="submit" value="Registrar">
    </form>
    <?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registros";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener registros de la base de datos
$sql = "SELECT id_nombre, nombre, edad, correo FROM personas";
$result = $conn->query($sql);

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Registros</title>
</head>
<body>
    <h1>Registros Almacenados</h1>

    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Mostrar registros en la tabla
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id_nombre']}</td>
                            <td>{$row['nombre']}</td>
                            <td>{$row['edad']}</td>
                            <td>{$row['correo']}</td>
                            <td>
                                <a href='editar.php?id={$row['id_nombre']}'>Editar</a> |
                                <a href='eliminar.php?id={$row['id_nombre']}'>Eliminar</a>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No hay registros</td></tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

</body>
</html>
