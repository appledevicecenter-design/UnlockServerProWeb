<?php
session_start();
$_SESSION['carrito'] = [];
header("Location: carrito_compras.php");
exit;
?>
