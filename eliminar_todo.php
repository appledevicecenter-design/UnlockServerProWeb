<?php
include "conexion.php";

// Eliminar todos los registros
$sql = "TRUNCATE TABLE registros"; // TRUNCATE elimina todo y reinicia el AUTO_INCREMENT

if ($conexion->query($sql)) {
    // Si todo sale bien, redirige a la página principal o donde prefieras
    header("Location: lista.php");
    exit();
} else {
    // Si hubo un error, muestra un mensaje de error
    echo "Error al eliminar los registros: " . $conexion->error;
}
?>
