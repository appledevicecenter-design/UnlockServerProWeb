<?php

// ======================
// ⚡ CONFIGURAR AQUÍ ⚡
// ======================
$bot_token = "8206068040:AAFpcjBLi70SUg-SDHYwT6UreZ-8iHethzQ";
$chat_id   = "6726478431";   // Personal o Grupo
// ======================


// Si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id = $_POST['id'];
    $correo = $_POST['correo'];
    $mensajeExtra = $_POST['mensaje'];

    // Archivo temporal subido
    $imagen = $_FILES['imagen']['tmp_name'];
    $nombre_original = $_FILES['imagen']['name'];

    // ---- MENSAJE DE TEXTO ----
    $texto = "📩 *Nuevo comprobante enviado*\n\n";
    $texto .= "🆔 *ID Pedido:* $id\n";
    $texto .= "📧 *Correo:* $correo\n";
    $texto .= "💬 *Mensaje:* $mensajeExtra\n";
    $texto .= "📅 *Fecha:* " . date("d/m/Y H:i");

    // Enviar texto
    $sendText = file_get_contents(
        "https://api.telegram.org/bot$bot_token/sendMessage?chat_id=$chat_id&text=" . urlencode($texto) . "&parse_mode=Markdown"
    );

    // ---------- ENVIAR IMAGEN ----------
    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.telegram.org/bot$bot_token/sendPhoto",
        CURLOPT_POST => true,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => [
            'chat_id' => $chat_id,
            'photo'   => new CURLFile($imagen, mime_content_type($imagen), $nombre_original)
        ]
    ]);

    $response = curl_exec($curl);
    $error    = curl_error($curl);
    curl_close($curl);


    // 🔍 DEBUG (muestra error si Telegram no envía)
    if ($error || strpos($response, '"ok":false') !== false) {
        echo "<pre>";
        echo "❌ ERROR ENVIANDO FOTO A TELEGRAM\n\n";
        echo "Curl Error:\n$error\n\n";
        echo "Respuesta Telegram:\n$response\n";
        echo "</pre>";
        exit;
    }

    // Si todo salió bien
    echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>";
    echo "
    <script>
        Swal.fire({
            title: 'Comprobante enviado ✔',
            text: 'Tu comprobante fue enviado correctamente al soporte.',
            icon: 'success'
        }).then(() => {
            window.location.href = 'index.php';
        });
    </script>";
    exit;
}


// Obtener ID si viene por GET
$id_pedido = isset($_GET['id']) ? $_GET['id'] : "";

?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Enviar Comprobante a Soporte</title>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
body{
    font-family: Arial;
    background: linear-gradient(135deg,#74ebd5,#ACB6E5);
    padding: 20px;
    margin:0;
}

.contenedor{
    max-width: 450px;
    background: #fff;
    margin: auto;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 0 15px rgba(0,0,0,.2);
}

h2{
    text-align:center;
    margin-bottom:20px;
}

input, textarea{
    width: 95%;
    padding: 12px;
    margin: 10px 0;
    border-radius: 8px;
    border: 1px solid #ccc;
}

button{
    width: 100%;
    background: #007BFF;
    color: #fff;
    padding: 12px;
    border: none;
    border-radius: 8px;
    font-size: 1.1em;
    cursor: pointer;
}
button:hover{
    background:#0056b3;
}
</style>

</head>
<body>

<div class="contenedor">

<h2>📤 Enviar Comprobante</h2>

<form method="POST" enctype="multipart/form-data">

    <label>ID del pedido</label>
    <input type="text" name="id" value="<?php echo $id_pedido; ?>" readonly>

    <label>Tu correo electrónico</label>
    <input type="email" name="correo" required>

    <label>Adjuntar comprobante (imagen)</label>
    <input type="file" name="imagen" accept="image/*" required>

    <label>Mensaje adicional (opcional)</label>
    <textarea name="mensaje" rows="4"></textarea>

    <button type="submit">📨 Enviar comprobante</button>
</form>

</div>

</body>
</html>
