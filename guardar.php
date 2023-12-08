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

// Obtener datos del formulario y escapar caracteres especiales
$nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($conn, $_POST['nombre']) : '';
$edad = isset($_POST['edad']) ? (int)$_POST['edad'] : 0;
$correo = isset($_POST['correo']) ? mysqli_real_escape_string($conn, $_POST['correo']) : '';

// Insertar datos en la base de datos
$sql = "INSERT INTO personas (nombre, edad, correo) VALUES ('$nombre', $edad, '$correo')";

if ($conn->query($sql) === TRUE) {
    // Redirigir a la página de éxito
    header("Location: index.php");
    exit();
} else {
    echo "Error al registrar: " . $conn->error;
}

// Cerrar la conexión
$conn->close();
?>


