<?php
include "conexion.php";
$error = "";
$registroExitoso = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST["nombre"];
    $email  = $_POST["email"];
    $password_real = $_POST["password"];   // Guardamos la contraseña tal cual
    $ip_usuario = $_SERVER['REMOTE_ADDR']; // Obtener IP del usuario

    $insert = $conexion->prepare("INSERT INTO usuarios (nombre, email, password_real, ip_usuario) VALUES (?, ?, ?, ?)");
    $insert->bind_param("ssss", $nombre, $email, $password_real, $ip_usuario);

    if ($insert->execute()) {
        $registroExitoso = true;
    } else {
        $error = "Error al Registrar";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Registrar Usuario - UNLOCKSERVERPRO</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

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
    width: 400px;
    background: rgba(255,255,255,0.07);
    padding: 40px 35px;
    border-radius: 15px;
    backdrop-filter: blur(12px);
    box-shadow: 0 10px 40px rgba(0,0,0,0.6);
    text-align: center;
}

h2 {
    font-weight: 600;
    font-size: 28px;
    margin-bottom: 25px;
}

input[type=text], input[type=email], input[type=password] {
    width: 100%;
    padding: 14px 12px;
    margin-bottom: 15px;
    border-radius: 10px;
    border: none;
    outline: none;
    background: rgba(255,255,255,0.15);
    color: #fff;
    font-size: 16px;
    transition: 0.3s;
}

input[type=text]:focus, input[type=email]:focus, input[type=password]:focus {
    background: rgba(255,255,255,0.25);
}

input[type=checkbox] { margin-right: 8px; }

button {
    width: 100%;
    padding: 14px;
    border: none;
    border-radius: 12px;
    background: linear-gradient(90deg, #1abc9c, #16a085);
    color: #fff;
    font-size: 17px;
    font-weight: 500;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: linear-gradient(90deg, #16a085, #1abc9c);
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
}

a {
    display: block;
    margin-top: 20px;
    color: #1abc9c;
    text-decoration: none;
    font-weight: 500;
}

a:hover {
    text-decoration: underline;
}
</style>
</head>
<body>

<div class="container">
    <h2>Crear Cuenta</h2>

    <form method="POST">
        <input type="text" name="nombre" placeholder="Usuario" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" id="password" placeholder="Contraseña" required>
        <div style="text-align:left; margin-bottom: 15px;">
            <input type="checkbox" onclick="togglePassword()"> Mostrar contraseña
        </div>
        <button type="submit">Registrarse</button>
    </form>

    <a href="login.php">Ya tengo cuenta</a>
</div>

<script>
function togglePassword() {
    var x = document.getElementById("password");
    x.type = x.type === "password" ? "text" : "password";
}

// Mostrar SweetAlert según el estado
<?php if ($registroExitoso): ?>
Swal.fire({
    icon: 'success',
    title: 'Registrado Exitosamente',
    text: 'Ahora puedes iniciar sesión',
    confirmButtonColor: '#1abc9c'
}).then(() => {
    window.location.href = "login.php";
});
<?php elseif (!empty($error)): ?>
Swal.fire({
    icon: 'error',
    title: 'Error',
    text: '<?php echo $error; ?>',
    confirmButtonColor: '#1abc9c'
});
<?php endif; ?>
</script>

</body>
</html>
