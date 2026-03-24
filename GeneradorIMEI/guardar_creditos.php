<?php
header('Content-Type: application/json');
require 'conexion.php';

// Telegram
$botToken = "TU_TOKEN_AQUI";
$chat_id = "TU_CHAT_ID";

// Leer JSON
$input = json_decode(file_get_contents('php://input'), true);

$usuario = trim($input['usuario'] ?? '');
$creditos = intval($input['creditos'] ?? 0);
$monto = floatval($input['monto'] ?? 0);
$metodo = trim($input['metodo'] ?? '');

if (!$usuario) {
    echo json_encode(['success' => false, 'msg' => 'Usuario vacío']);
    exit;
}

// Verificar usuario
$stmt = $conn->prepare("SELECT creditos FROM usuarios WHERE usuario=?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $nuevos = $row['creditos'] + $creditos;

    if ($nuevos < 0) $nuevos = 0; // evita negativos

    $update = $conn->prepare("UPDATE usuarios SET creditos=? WHERE usuario=?");
    $update->bind_param("is", $nuevos, $usuario);
    $update->execute();

} else {
    $insert = $conn->prepare("INSERT INTO usuarios (usuario, creditos) VALUES (?, ?)");
    $insert->bind_param("si", $usuario, $creditos);
    $insert->execute();
}

// Telegram solo si es compra
if ($creditos > 0 && $monto > 0) {
    $mensaje = "PAGO CONFIRMADO ✅\nUsuario: $usuario\nMétodo: $metodo\nCréditos: $creditos\nMonto: $$monto";

    $url = "https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chat_id&text=" . urlencode($mensaje);

    // CURL (más seguro)
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
}

echo json_encode(['success' => true]);
$conn->close();
?>
