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

// Manejo del formulario de actualización
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id_editar'])) {
    $id_editar = $_POST['id_editar'];
    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($conn, $_POST['nombre']) : '';
    $edad = isset($_POST['edad']) ? (int)$_POST['edad'] : 0;
    $correo = isset($_POST['correo']) ? mysqli_real_escape_string($conn, $_POST['correo']) : '';

    // Actualizar datos en la base de datos
    $sql = "UPDATE personas SET nombre='$nombre', edad=$edad, correo='$correo' WHERE id_nombre='$id_editar'";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Registro actualizado correctamente.</p>";
    } else {
        echo "Error al actualizar: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color: #333;
            color: #fff;
            padding: 20px;
            margin: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        p {
            color: green;
        }

        a {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
        }

        a:hover {
            background-color: #555;
        }
    </style>
    <title>Actualizar Registro</title>
</head>
<body>
    <h1>Actualizar Registro</h1>
    <p>La actualización se ha realizado.</p>
    <a href="mostrar_registros.php">Volver a la lista de registros</a>
</body>
</html>
