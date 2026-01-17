<?php
session_start();
require_once "conexion.php";

$id = $_GET['id'] ?? null;
if(!$id) exit('ID de producto inválido');

$sql = "SELECT * FROM productos WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows === 0) exit('Producto no encontrado');

$producto = $result->fetch_assoc();

// Inicializar carrito si no existe
if(!isset($_SESSION['carrito'])) $_SESSION['carrito'] = [];

// Verificar si el producto ya está en el carrito
$encontrado = false;
foreach($_SESSION['carrito'] as &$item){
    if($item['id'] == $producto['id']){
        $item['cantidad']++;
        $encontrado = true;
        break;
    }
}
unset($item);

if(!$encontrado){
    $_SESSION['carrito'][] = [
        'id' => $producto['id'],
        'nombre' => $producto['nombre'],
        'precio' => $producto['precio'],
        'cantidad' => 1
    ];
}

header('Location: index.php');
exit;
?>
