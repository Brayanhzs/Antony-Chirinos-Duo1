<?php
include 'db.php';

$mensaje = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST["nombre"]);
    $correo = trim($_POST["correo"]);
    $edad = trim($_POST["edad"]);

    // Validación: campos vacíos
    if (empty($nombre) || empty($correo) || empty($edad)) {
        $mensaje = "Todos los campos son obligatorios.";
    }
    // Validación: nombre solo letras y espacios
    elseif (!preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+$/", $nombre)) {
        $mensaje = "El nombre solo debe contener letras y espacios.";
    }
    // Validación: correo válido
    elseif (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "El correo no es válido.";
    }
    // Validación: edad válida
    elseif (!is_numeric($edad) || $edad <= 0 || $edad > 120) {
        $mensaje = "La edad debe ser un número válido entre 1 y 120.";
    }
    else {
        $sql = "INSERT INTO usuarios (nombre, correo, edad) VALUES ('$nombre', '$correo', $edad)";
        if ($conexion->query($sql)) {
            $mensaje = "Registro creado correctamente.";
        } else {
            $mensaje = "Error al guardar: " . $conexion->error;
        }
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Crear Usuario</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h2>Crear Nuevo Usuario</h2>
    <form method="POST">
        <label>Nombre:</label><br>
        <input type="text" name="nombre" required><br><br>

        <label>Correo:</label><br>
        <input type="email" name="correo" required><br><br>

        <label>Edad:</label><br>
        <input type="number" name="edad" min="1" required><br><br>

        <input type="submit" value="Guardar">
        <a href="indextwo.php">Volver</a>
    </form>
    <p><?= $mensaje ?></p>
</body>
</html>
