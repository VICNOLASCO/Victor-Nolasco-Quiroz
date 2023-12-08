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

// Obtener el ID del registro a eliminar
$id_eliminar = isset($_POST['id_eliminar']) ? $_POST['id_eliminar'] : '';

// Eliminar el registro
$sql = "DELETE FROM personas WHERE id_nombre = '$id_eliminar'";
if ($conn->query($sql) === TRUE) {
    $mensaje = "Registro eliminado correctamente.";
} else {
    $mensaje = "Error al eliminar el registro: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Registro</title>
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

        p {
            color: #333;
        }

        strong {
            color: #555;
        }
    </style>
</head>

<body>
    <h1>Eliminar Registro</h1>

    <p><?php echo $mensaje; ?></p>

    <p><a href="mostrar_registros.php">Volver a la lista de registros</a></p>
</body>

</html>
