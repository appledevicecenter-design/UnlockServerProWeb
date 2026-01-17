<?php
session_start();
if (!isset($_SESSION["id"])) {
    // Si no hay sesión, redirigir a login
    header("Location: login.php");
    exit;
}

// Nombre del usuario desde sesión
$usuario = $_SESSION["nombre"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>UNLOCKSERVERPRO</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Roboto', sans-serif;
            background: linear-gradient(135deg, #001f3f, #001020);
            color: #fff;
            min-height: 100vh;
            position: relative;
        }

        /* Header */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 50px;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(8px);
        }

        header h1 {
            font-size: 2em;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.7);
        }

        .auth-buttons a, .auth-user {
            text-decoration: none;
            margin-left: 15px;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.3s;
        }

        .auth-login { background: #1abc9c; color: #fff;}        /* Turquesa */
        .auth-login:hover { background: #16a085; color: #fff; }
        .auth-register { background: #e67e22; color: #fff; }     /* Naranja */
        .auth-register:hover { background: #d35400;  color: #fff;}

        .auth-user {
            background: #3498db; /* Azul */
        }

        /* Main Dashboard */
        .dashboard {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 60px 20px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            width: 100%;
            max-width: 1200px;
            margin-bottom: 50px;
        }

        .card {
            background: rgba(255,255,255,0.05);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 15px;
            padding: 40px 20px;
            text-align: center;
            transition: 0.3s;
            cursor: pointer;
            backdrop-filter: blur(8px);
        }

        .card:hover {
            background: rgba(255,255,255,0.15);
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
        }

        .card a, .card button {
            text-decoration: none;
            color: #fff;
            font-weight: bold;
            font-size: 1.2em;
            display: inline-block;
            padding: 15px 25px;
            border-radius: 8px;
            transition: 0.3s;
            border: none;
        }

        /* Colores de botones */
        .boton-agregar { background-color: #3498db; }
        .boton-verificar { background-color: #9b59b6; }
        .boton-activacion { background-color: #e74c3c; }
        .boton-renovacion { background-color: #f39c12; }
        .boton-renta { background-color: #2ecc71; }
        .boton-phishing { background-color: #f1c40f; color: #000; }
        .boton-frp { background-color: #e84393; }
        .boton-honor { background-color: #00cec9; }
        .boton-via { background-color: #fd79a8; }
        .boton-soporte { background-color: #636e72; }

        .fondo {
            position: fixed;
            top: 50%;
            left: 50%;
            width: 50%;
            transform: translate(-50%, -50%);
            opacity: 0.08;
            z-index: -1;
        }

        /* Modal */
        .modal {
            display: none;
            position: fixed;
            left: 0; top: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.7);
            justify-content: center;
            align-items: center;
            z-index: 999;
        }

        .modal-content {
            background: #fff;
            padding: 30px;
            color: #000;
            border-radius: 15px;
            text-align: center;
            position: relative;
            max-width: 400px;
            width: 90%;
            animation: fadeIn 0.3s ease-in-out;
        }

        .cerrar {
            position: absolute;
            top: 10px; right: 15px;
            font-size: 25px;
            cursor: pointer;
        }

        .modal-content img {
            width: 250px;
            margin-top: 15px;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: scale(0.8);}
            to {opacity: 1; transform: scale(1);}
        }

        @media(max-width:600px){
            header { flex-direction: column; gap: 15px; padding: 20px; }
            header h1 { font-size: 1.8em; }
        }
    </style>
</head>
<body>

    <!-- Fondo decorativo -->
    <img src="img/fondo.png" class="fondo" alt="Fondo">

    <!-- Header con usuario logueado -->
    <header>
        <h1>UNLOCKSERVERPRO</h1>
        <div class="auth-buttons">
            <span class=""><?php echo htmlspecialchars($usuario); ?></span>
            <a class="auth-login" href="login.php">Login</a> 
            <a class="auth-register" href="registrar.php">Registrer</a>
            <a class="auth-login" href="logout.php">Logout</a>
        </div>
    </header>

    <!-- Panel principal -->
    <div class="dashboard">
        <div class="cards">
            <div class="card"><a class="boton boton-agregar" href="agregar.php">Agregar Pedido</a></div>
            <div class="card"><a class="boton boton-verificar" href="listaactualizada.php">Verificar Registros</a></div>
            <div class="card"><a class="boton boton-activacion" href="agregar.php">Realizar Activación</a></div>
            <div class="card"><a class="boton boton-renovacion" href="agregar.php">Realizar Renovación</a></div>
            <div class="card"><a class="boton boton-renta" href="agregar.php">Renta de Tools</a></div>
            <div class="card"><a class="boton boton-phishing" href="agregar.php">Comprar Panel Phishing</a></div>
            <div class="card"><a class="boton boton-frp" href="frp.php">FRP HONOR VIA SN</a></div>
            <div class="card"><button class="boton boton-soporte" onclick="abrirQR()">Contacto & Soporte</button></div>
        </div>
    </div>

    <!-- Modal QR -->
    <div id="modalQR" class="modal">
        <div class="modal-content">
            <span class="cerrar" onclick="cerrarQR()">&times;</span>
            <h3>Escanea este QR</h3>
            <img src="./img/qr.png" alt="QR">
        </div>
    </div>

    <script>
        function abrirQR(){ document.getElementById('modalQR').style.display = 'flex'; }
        function cerrarQR(){ document.getElementById('modalQR').style.display = 'none'; }
    </script>

</body>
</html>
