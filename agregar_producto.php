<?php
require_once "conexion.php";

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $conexion->real_escape_string($_POST['nombre']);
    $precio = floatval($_POST['precio']);

    // Subida de imagen
    if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0){
        $nombreImagen = time() . "_" . $_FILES['imagen']['name'];
        $rutaDestino = "imagenes/" . $nombreImagen;
        move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino);

        $sql = "INSERT INTO productos (nombre, precio, imagen) VALUES ('$nombre', $precio, '$nombreImagen')";
        if($conexion->query($sql)){
            header("Location: carrito_compras.php");
            exit;
        } else {
            echo "Error al agregar producto: " . $conexion->error;
        }
    }
}
?>
