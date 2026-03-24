<?php
header('Content-Type: application/json');
require 'conexion.php';

$usuario = $_GET['usuario'] ?? '';

if (!$usuario) {
    echo json_encode(['success' => false, 'creditos' => 0]);
    exit;
}

$stmt = $conn->prepare("SELECT creditos FROM usuarios WHERE usuario=?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode(['success' => true, 'creditos' => $row['creditos']]);
} else {
    echo json_encode(['success' => true, 'creditos' => 0]);
}

$conn->close();
?>
