<?php
include 'db.php';

$mensaje = "";

// Obtener ID del registro
if (!isset($_GET["id"])) {
    header("Location: indextwo.php");
    exit();
}

$id = $_GET["id"];

// Si se envió el formulario (POST), actualizamos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $correo = trim($_POST["correo"]);
    $edad = (int)$_POST["edad"];

    if ($nombre != "" && filter_var($correo, FILTER_VALIDATE_EMAIL) && $edad > 0) {
        $sql = "UPDATE usuarios SET nombre='$nombre', correo='$correo', edad=$edad WHERE id=$id";
        if ($conexion->query($sql)) {
            $mensaje = "Registro actualizado correctamente.";
        } else {
            $mensaje = "Error: " . $conexion->error;
        }
    } else {
        $mensaje = "Por favor completa todos los campos correctamente.";
    }
}

// Obtener los datos actuales del usuario
$resultado = $conexion->query("SELECT * FROM usuarios WHERE id=$id");
$usuario = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h2>Editar Usuario</h2>
    <form method="POST">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" value="<?= $usuario['nombre'] ?>" required><br><br>

        <label>Correo:</label><br>
        <input type="email" name="correo" value="<?= $usuario['correo'] ?>" required><br><br>

        <label>Edad:</label><br>
        <input type="number" name="edad" value="<?= $usuario['edad'] ?>" min="1" required><br><br>

        <input type="submit" value="Actualizar">
        <a href="indextwo.php">Volver</a>
    </form>
    <p><?= $mensaje ?></p>
</body>
</html>
