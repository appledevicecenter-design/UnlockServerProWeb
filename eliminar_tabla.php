<?php
require_once "conexion.php";
$sql = "TRUNCATE TABLE productos";
$conexion->query($sql);
header("Location: carrito_compras.php");
exit;
?>
