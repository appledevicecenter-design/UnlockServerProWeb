<?php
header('Content-Type: application/json');

// DB config
$servername = "localhost";
$dbname = "generador_imei";
$dbuser = "root";
$dbpass = "";

// Telegram
$botToken = "AAEHuvJXvBhyg9KWYtqDh6dZc798Tck8l44";
$chat_id = "8764642751";

// Leer JSON
$input = json_decode(file_get_contents('php://input'), true);
$usuario = trim($input['usuario'] ?? '');
$creditos = intval($input['creditos'] ?? 0);
$monto = floatval($input['monto'] ?? 0);
$metodo = trim($input['metodo'] ?? '');

// Validación mínima
if(!$usuario){
    echo json_encode(['success'=>false,'msg'=>'Usuario vacío']);
    exit;
}

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Ver si el usuario ya existe
    $stmt = $conn->prepare("SELECT creditos FROM usuarios WHERE usuario=?");
    $stmt->execute([$usuario]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if($row){
        $nuevos = $row['creditos'] + $creditos;
        $stmt = $conn->prepare("UPDATE usuarios SET creditos=? WHERE usuario=?");
        $stmt->execute([$nuevos, $usuario]);
    } else {
        $stmt = $conn->prepare("INSERT INTO usuarios (usuario, creditos) VALUES (?, ?)");
        $stmt->execute([$usuario, $creditos]);
    }

    // Enviar mensaje a Telegram si es un pago real
    if($creditos > 0 && $monto > 0){
        $mensaje = "PAGO CONFIRMADO ✅\nUsuario: $usuario\nMétodo: $metodo\nCréditos: $creditos\nMonto: $$monto";
        $url = "https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chat_id&text=".urlencode($mensaje);
        file_get_contents($url);
    }

    echo json_encode(['success'=>true]);

} catch(Exception $e){
    echo json_encode(['success'=>false,'msg'=>$e->getMessage()]);
}
?>