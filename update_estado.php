<?php
// Conectar a la base de datos
include "conexion.php";

// Verificar que se envíen los datos
if(isset($_POST['id']) && isset($_POST['estado'])) {

    $id = intval($_POST['id']); // Asegurarse que sea un número
    $estado = trim($_POST['estado']); // Limpiar espacios

    // Validar que el estado sea uno de los permitidos
    $estados_validos = ["Ingresado", "En proceso", "Exito", "Rechazado"];
    if(!in_array($estado, $estados_validos)) {
        die("Estado no válido");
    }

    // Actualizar en la base de datos
    $sql = "UPDATE registros SET estado=? WHERE id=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("si", $estado, $id);

    if($stmt->execute()) {
        // Redirigir a la lista
        header("Location: lista.php");
        exit;
    } else {
        echo "Error al actualizar: " . $conexion->error;
    }

} else {
    echo "Datos incompletos.";
}
?>
