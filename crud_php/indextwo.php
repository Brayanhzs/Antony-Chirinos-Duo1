<?php
include 'db.php';
$resultado = $conexion->query("SELECT * FROM usuarios");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Lista de Usuarios</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <h2>Lista de Usuarios</h2>
    <a href="crear.php">+ Crear nuevo</a>
    <table border="1">
        <tr>
            <th>ID</th><th>Nombre</th><th>Correo</th><th>Edad</th><th>Acciones</th>
        </tr>
        <?php while($fila = $resultado->fetch_assoc()){ ?>
        <tr>
            <td><?= $fila['id'] ?></td>
            <td><?= $fila['nombre'] ?></td>
            <td><?= $fila['correo'] ?></td>
            <td><?= $fila['edad'] ?></td>
            <td>
                <a href="editar.php?id=<?= $fila['id'] ?>">Editar</a> |
                <a href="eliminar.php?id=<?= $fila['id'] ?>" onclick="return confirm('¿Seguro que quieres eliminar?')">Eliminar</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>
