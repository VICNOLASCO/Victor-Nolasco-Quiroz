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
$id_eliminar = isset($_GET['id']) ? $_GET['id'] : '';

// Obtener datos del registro a eliminar (puedes mostrarlos si lo deseas)
$sql = "SELECT nombre, edad, correo FROM personas WHERE id_nombre = '$id_eliminar'";
$result = $conn->query($sql);

// Cerrar la conexión
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Registro</title>
</head>
<body>
    <h1>Eliminar Registro</h1>

    <?php
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        ?>

        <p>¿Estás seguro de que deseas eliminar el siguiente registro?</p>
        <p><strong>Nombre:</strong> <?php echo $row['nombre']; ?></p>
        <p><strong>Edad:</strong> <?php echo $row['edad']; ?></p>
        <p><strong>Correo:</strong> <?php echo $row['correo']; ?></p>

        <form action="eliminar_confirmar.php" method="post">
    <input type="hidden" name="id_eliminar" value="<?php echo $id_eliminar; ?>">
    <input type="submit" value="Confirmar Eliminación">
</form>


        <?php
    } else {
        echo "<p>Registro no encontrado</p>";
    }
    ?>
</body>
</html>
