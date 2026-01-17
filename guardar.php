<?php
include "conexion.php";

$imei_sn = $_POST['imei_sn'];
$modelo = $_POST['modelo'];
$servicio = $_POST['servicio'];

// Validar IMEI (15 dígitos)
if(!preg_match('/^\d{15}$/', $imei_sn)) {
    die("Error: El IMEI debe contener exactamente 15 dígitos.");
}

// Insertar en la base de datos
$sql = "INSERT INTO registros (imei_sn, modelo, servicio) VALUES ('$imei_sn', '$modelo', '$servicio')";

if ($conexion->query($sql)) {

   

    // URL de redirección después de X segundos
    $redireccion = "/UnlockServerPro/listaactualizada.php";
    $tiempo_redireccion = 5; // segundos

    // Mensaje personalizado según el servicio
    $mensaje = "";
    switch($servicio){
        case "Nothing - iRemoval Pro - LU WIFI":
            $mensaje = "SN Added successfully, use the tool to activate it now !! with iRemoval PRO Premium Edition V5 NO-SIGNAL";
            break;
        case "Iremove Tool":
        case "LOLToolBypass A12+ - iAPro A12+":
        case "iRealm - Artem1s Activator A12+":
        case "HFZ - OTIX - FRP Activator":
            $mensaje = "SN Added successfully, use the tool to activate it now !!";
            break;
        default:
            $mensaje = "SN Added successfully.";
    }
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Confirmación de Registro</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background: linear-gradient(135deg, #74ebd5, #ACB6E5);
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                margin: 0;
            }

            .container {
                background-color: #fff;
                padding: 40px 50px;
                border-radius: 15px;
                box-shadow: 0 10px 30px rgba(0,0,0,0.2);
                text-align: center;
                max-width: 400px;
                width: 100%;
            }

            h2 {
                color: #333;
                margin-bottom: 20px;
                font-size: 24px;
            }

            p {
                font-size: 16px;
                margin-top: 10px;
                color: #555;
            }

            .mensaje {
                font-weight: bold;
                color: #007BFF;
                margin-top: 15px;
            }

            img {
                width: 200px;
                margin: 20px 0;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            }

            .contador {
                font-weight: bold;
                color: #007BFF;
                font-size: 18px;
            }

            a, button {
                display: inline-block;
                margin-top: 20px;
                text-decoration: none;
                color: white;
                padding: 10px 20px;
                border-radius: 5px;
                transition: background-color 0.3s;
                font-size: 16px;
                border: none;
                cursor: pointer;
            }

            a {
                background-color: #28a745;
            }

            a:hover {
                background-color: #218838;
            }

            button {
                background-color: #ffc107;
                color: black;
            }

            button:hover {
                background-color: #e0a800;
            }

        </style>

        <script>
            let tiempo = <?php echo $tiempo_redireccion; ?>;
            function actualizarContador() {
                document.getElementById('contador').innerText = tiempo;
                tiempo--;
                if(tiempo < 0) {
                    window.location.href = "<?php echo $redireccion; ?>";
                } else {
                    setTimeout(actualizarContador, 1000);
                }
            }
            window.onload = actualizarContador;
        </script>
    </head>
    <body>

    <div class="container">
        <h2>Registrado Correctamente 🔥</h2>
        <p>IMEI/SN: <?php echo $imei_sn; ?></p>
        <p>Modelo: <?php echo $modelo; ?></p>
        <p>Servicio: <?php echo $servicio; ?></p>
        <p class="mensaje"><?php echo $mensaje; ?></p>
       
        <p>Serás redirigido automáticamente en <span class="contador" id="contador"><?php echo $tiempo_redireccion; ?></span> segundos.</p>

    
        <!-- 🔥 BOTÓN NUEVO: CONFIRMAR PAGO -->
        <form action="confirmar_pago.php" method="POST">
            <input type="hidden" name="imei_sn" value="<?php echo $imei_sn; ?>">
            <input type="hidden" name="modelo" value="<?php echo $modelo; ?>">
            <input type="hidden" name="servicio" value="<?php echo $servicio; ?>">
           
        </form>

    </div>

    </body>
    </html>

<?php
} else {
    echo "Error al registrar: " . $conexion->error;
}
?>
