<?php
// Conexión a la base de datos
$host = "localhost";
$user = "root";
$pass = "";
$db   = "iphone_db";

$conexion = new mysqli($host, $user, $pass, $db);
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

$mensaje = "";
$tipoMensaje = "";

// Insertar dispositivo
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['agregar'])) {
    $imei   = $_POST["imei"] ?? "";
    $serie  = $_POST["serie"] ?? "";
    $modelo = $_POST["modelo"] ?? "";

    // Validar IMEI: solo números y 15 dígitos
    if (!preg_match('/^[0-9]{15}$/', $imei)) {
        $mensaje = "El IMEI debe contener exactamente 15 dígitos numéricos";
        $tipoMensaje = "error";
    } elseif (!empty($serie) && !empty($modelo)) {

        // Evitar IMEI duplicado
        $check = $conexion->prepare("SELECT id FROM dispositivos WHERE imei=?");
        $check->bind_param("s", $imei);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {
            $mensaje = "El IMEI ya está registrado";
            $tipoMensaje = "error";
        } else {
            $stmt = $conexion->prepare("INSERT INTO dispositivos (imei, serie, modelo) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $imei, $serie, $modelo);

            if ($stmt->execute()) {
                $mensaje = "Dispositivo agregado correctamente";
                $tipoMensaje = "success";
            } else {
                $mensaje = "Error al agregar dispositivo";
                $tipoMensaje = "error";
            }
            $stmt->close();
        }
        $check->close();
    } else {
        $mensaje = "Completa todos los campos";
        $tipoMensaje = "error";
    }
}

// Limpiar tabla
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['limpiar'])) {
    if ($conexion->query("TRUNCATE TABLE dispositivos")) {
        $mensaje = "Todos los registros fueron eliminados";
        $tipoMensaje = "success";
    } else {
        $mensaje = "Error al limpiar la tabla";
        $tipoMensaje = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>FRP HONOR UNLOCKSERVERPRO</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <style>
        body {
            font-family: Arial;
            background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
            margin: 0;
            padding: 0;
            user-select: none;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 25px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 0 25px rgba(0,0,0,0.4);
        }

        h2 {
            text-align: center;
            color: #0f2027;
            margin-bottom: 25px;
        }

        form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: center;
        }

        input {
            flex: 1 1 160px;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        button {
            padding: 12px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: bold;
            transition: 0.3s;
        }

        .agregar {
            background-color: #28a745;
            color: white;
        }

        .agregar:hover {
            background-color: #218838;
        }

        .limpiar {
            background-color: #dc3545;
            color: white;
        }

        .limpiar:hover {
            background-color: #c82333;
        }

        p.privado {
            text-align: center;
            margin-top: 30px;
            color: #dc3545;
            font-weight: bold;
        }

        /* Tabla totalmente oculta */
        .tabla-privada {
            display: none;
        }

        @media print {
            body { display: none; }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>FRP HONOR UNLOCKSERVERPRO</h2>

    <form method="POST" action="frp.php">
        <input type="text" name="imei" placeholder="IMEI (15 dígitos)" maxlength="15" pattern="[0-9]{15}" required>
        <input type="text" name="serie" placeholder="Número de serie" required>
        <input type="text" name="modelo" placeholder="Modelo" required>

        <button type="submit" name="agregar" class="agregar">Agregar</button>
        <button type="button" id="btnLimpiar" class="limpiar">Limpiar Tabla</button>
    </form>

    <p class="privado">
        ⚠️ La información de los dispositivos es privada y no se muestra en esta página.
    </p>
</div>

<?php if ($mensaje): ?>
<script>
Swal.fire({
    icon: '<?php echo $tipoMensaje; ?>',
    title: '<?php echo $mensaje; ?>',
    timer: 2200,
    showConfirmButton: false
});
</script>
<?php endif; ?>

<script>
document.getElementById('btnLimpiar').addEventListener('click', function () {
    Swal.fire({
        title: '¿Eliminar todo?',
        text: 'Esta acción borrará todos los dispositivos',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#dc3545',
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Sí, borrar'
    }).then((result) => {
        if (result.isConfirmed) {
            const f = document.createElement('form');
            f.method = 'POST';
            f.action = 'frp.php';

            const i = document.createElement('input');
            i.type = 'hidden';
            i.name = 'limpiar';
            i.value = '1';

            f.appendChild(i);
            document.body.appendChild(f);
            f.submit();
        }
    });
});
</script>

</body>
</html>
