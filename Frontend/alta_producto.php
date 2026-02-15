<?php
// Configuración de conexión
$host = "localhost";
$user = "root";
$password = "";
$database = "inventario";

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre = trim($_POST["nombre"]);
    $descripcion = trim($_POST["descripcion"]);
    $precio = floatval($_POST["precio"]);
    $stock = intval($_POST["stock"]);

    // Validación básica
    if (empty($nombre) || $precio <= 0 || $stock < 0) {
        $mensaje = "Datos inválidos. Verifique la información.";
    } else {

        $stmt = $conn->prepare(
            "INSERT INTO producto (nombre, descripcion, precio, stock, fecha_creacion) 
             VALUES (?, ?, ?, ?, NOW())"
        );

        $stmt->bind_param("ssdi", $nombre, $descripcion, $precio, $stock);

        if ($stmt->execute()) {
            $mensaje = "Producto registrado correctamente.";
        } else {
            $mensaje = "Error al registrar: " . $stmt->error;
        }

        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Alta de Producto</title>
</head>
<body>

<h2>Registrar Producto</h2>

<?php if (!empty($mensaje)) : ?>
    <p><strong><?php echo $mensaje; ?></strong></p>
<?php endif; ?>

<form method="POST" action="">
    <label>Nombre:</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Descripción:</label><br>
    <textarea name="descripcion"></textarea><br><br>

    <label>Precio:</label><br>
    <input type="number" step="0.01" name="precio" required><br><br>

    <label>Stock:</label><br>
    <input type="number" name="stock" required><br><br>

    <button type="submit">Guardar</button>
</form>

</body>
</html>
