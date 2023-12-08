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

// Manejo de la acción de eliminar
if (isset($_GET['action']) && $_GET['action'] == 'eliminar') {
    $id_a_eliminar = isset($_GET['id']) ? $_GET['id'] : '';
    
    // Realizar la eliminación en la base de datos
    $sql = "DELETE FROM personas WHERE id_nombre = '$id_a_eliminar'";
    $conn->query($sql);
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
    <title>Registros</title>
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

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 12px;
        }

        th {
            background-color: #f2f2f2;
        }

        .acciones a {
            display: inline-block;
            padding: 8px 12px;
            text-decoration: none;
            background-color: #4caf50;
            color: #fff;
            border-radius: 4px;
            margin-right: 5px;
        }

        .acciones a:hover {
            background-color: #45a049;
        }

        .mensaje-eliminar {
            color: green;
        }

        .no-registros {
            font-style: italic;
            color: #777;
        }
    </style>
</head>
<body>
    <h1>Registros Almacenados</h1>

    <?php
    if (isset($_GET['action']) && $_GET['action'] == 'eliminar') {
        echo "<p style='color: green;'>Registro eliminado correctamente.</p>";
    }
    ?>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Correo</th>
                <th class="acciones">Acciones</th>
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
                            <td class='acciones'>
                                <a href='editar.php?id={$row['id_nombre']}'>Editar</a>
                                <a href='mostrar_registros.php?action=eliminar&id={$row['id_nombre']}'>Eliminar</a>
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
