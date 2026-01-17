<?php
session_start();
include "conexion.php";
$error = "";
$loginExitoso = false;

// Función para enviar mensaje a Telegram
function enviarTelegram($mensaje) {
    $token = "8286894428:AAERM6KRC_OFeuoNFcffL9tsamhauqmqCf8";
    $chat_id = "6726478431";

    $url = "https://api.telegram.org/bot$token/sendMessage";

    $data = [
        'chat_id' => $chat_id,
        'text' => $mensaje,
        'parse_mode' => 'HTML'
    ];

    $options = array(
        'http' => array(
            'method'  => 'POST',
            'header'  => "Content-Type:application/x-www-form-urlencoded\r\n",
            'content' => http_build_query($data),
        )
    );

    $context  = stream_context_create($options);
    file_get_contents($url, false, $context);
}

// Procesar formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $pass  = $_POST["password"];

    $consulta = $conexion->prepare("SELECT id, nombre, password_real FROM usuarios WHERE email = ?");
    $consulta->bind_param("s", $email);
    $consulta->execute();
    $consulta->store_result();

    if ($consulta->num_rows > 0) {
        $consulta->bind_result($id, $nombre, $password_real);
        $consulta->fetch();

        if ($pass === $password_real) {
            // Guardar datos en sesión
            $_SESSION["id"] = $id;
            $_SESSION["nombre"] = $nombre;

            // Enviar mensaje a Telegram
            $mensaje = "✅ Nuevo inicio de sesión:\nNombre: $nombre\nEmail: $email\nID Usuario: $id";
            enviarTelegram($mensaje);

            $loginExitoso = true;
        } else {
            $error = "Datos incorrectos";
        }
    } else {
        $error = "Datos incorrectos";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Login - UNLOCKSERVERPRO</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
body {
    margin: 0;
    font-family: 'Poppins', sans-serif;
    background: linear-gradient(135deg, #0a0f24, #02050f);
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    color: #fff;
}

.container {
    width: 380px;
    background: rgba(255,255,255,0.07);
    padding: 35px;
    border-radius: 15px;
    backdrop-filter: blur(10px);
    box-shadow: 0 10px 40px rgba(0,0,0,0.5);
}

h2 {
    margin-bottom: 20px;
    text-align: center;
    font-weight: 600;
    font-size: 28px;
}

input {
    width: 100%;
    padding: 12px;
    margin-top: 10px;
    border-radius: 8px;
    border: none;
    outline: none;
    background: rgba(255,255,255,0.15);
    color: #fff;
}

button {
    width: 100%;
    margin-top: 20px;
    padding: 12px;
    border: none;
    border-radius: 8px;
    background: #1abc9c;
    color: #fff;
    font-size: 17px;
    cursor: pointer;
    transition: 0.3s;
}
button:hover {
    background: #16a085;
}

a {
    text-align: center;
    display: block;
    margin-top: 15px;
    color: #1abc9c;
    text-decoration: none;
}
a:hover {
    text-decoration: underline;
}
</style>

</head>
<body>

<div class="container">
    <h2>Iniciar Sesión</h2>

    <form method="POST">
        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Contraseña:</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Entrar</button>
    </form>

    <a href="registrar.php">Crear cuenta</a>
</div>

<?php if (!empty($error)): ?>
<script>
Swal.fire({
    icon: 'error',
    title: 'Datos Incorrectos',
    text: '<?php echo $error; ?>',
    confirmButtonColor: '#1abc9c'
});
</script>
<?php endif; ?>

<?php if ($loginExitoso): ?>
<script>
Swal.fire({
    icon: 'success',
    title: 'Datos Encontramos',
    text: 'Ingresando...',
    showConfirmButton: false,
    timer: 2000,
    background: '#0a0f24',
    color: '#fff'
}).then(() => {
    window.location.href = "index.php";
});
</script>
<?php endif; ?>

</body>
</html>
