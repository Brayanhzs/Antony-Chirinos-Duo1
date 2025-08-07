<?php
include 'db.php';

if (isset($_GET["id"])) {
    $id = $_GET["id"];

    // Validamos si el registro existe antes de eliminar
    $resultado = $conexion->query("SELECT * FROM usuarios WHERE id=$id");

    if ($resultado->num_rows > 0) {
        $conexion->query("DELETE FROM usuarios WHERE id=$id");
    }
}

header("Location: indextwo.php");
exit();
?>
