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

// Obtener el ID del registro a editar
$id_editar = isset($_GET['id']) ? $_GET['id'] : '';

// Obtener datos del registro a editar
$sql = "SELECT nombre, edad, correo FROM personas WHERE id_nombre = '$id_editar'";
$result = $conn->query($sql);

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Registro</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            text-align: center;
        }

        h1 {
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        p {
            color: #333;
        }
    </style>
</head>
<body>
    <h1>Editar Registro</h1>

    <?php
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>

        <form action="actualizar.php" method="post">
            <input type="hidden" name="id_editar" value="<?php echo $id_editar; ?>">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $row['nombre']; ?>" required><br>

            <label for="edad">Edad:</label>
            <input type="number" id="edad" name="edad" value="<?php echo $row['edad']; ?>" required><br>

            <label for="correo">Correo:</label>
            <input type="email" id="correo" name="correo" value="<?php echo $row['correo']; ?>" required><br>

            <input type="submit" value="Actualizar">
        </form>

        <?php
    } else {
        echo "<p>Registro no encontrado</p>";
    }
    ?>
</body>
</html>

