<?php
include "conexion.php";

// Datos de Telegram
$bot_token = "7349363022:AAGT_5qETuSuBVEzFggFbYwgR7ncr2AW6xA";
$chat_id = "6726478431";

if(isset($_POST['cambiar_pago'])) {
    $id_pago = intval($_POST['id_pago']);
    $nuevo_status = $_POST['status_pago']; 

    $res = $conexion->query("SELECT * FROM registros WHERE id=$id_pago");
    $fila = $res->fetch_assoc();

    $conexion->query("UPDATE registros SET status_pago='$nuevo_status', fecha=NOW() WHERE id=$id_pago");

    $mensaje = ($nuevo_status=="Pagado") ? "✅ Pedido Pagado\n" : "⚠️ Pago Pendiente\n";
    $mensaje .= "ID: ".$fila['id']."\n";
    $mensaje .= "IMEI/SN: ".$fila['imei_sn']."\n";
    $mensaje .= "Modelo: ".$fila['modelo']."\n";
    $mensaje .= "Servicio: ".$fila['servicio']."\n";
    $mensaje .= "Estado: ".$fila['estado']."\n";
    $mensaje .= "Pago: ".$nuevo_status;
    $mensaje = urlencode($mensaje);

    file_get_contents("https://api.telegram.org/bot$bot_token/sendMessage?chat_id=$chat_id&text=$mensaje");
}

$resultado = $conexion->query("SELECT * FROM registros ORDER BY fecha DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>UNLOCKSERVERPRO - Panel de Pedidos</title>

<style>
body { font-family: 'Segoe UI', Arial, sans-serif; background: #eef2f3; margin: 0; padding: 15px; }
.header { background: linear-gradient(135deg, #4e54c8, #8f94fb); padding: 25px; border-radius: 15px; color: white; display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; box-shadow: 0 4px 18px rgba(0,0,0,0.3);}
.titulo { margin:0; font-size:2.3rem; font-weight:bold;}
.subtitulo { margin-top:5px; font-size:1rem; opacity:.9;}
.header-right { display:flex; gap:10px;}
.btn-superior { background:white; color:#4e54c8; padding:10px 16px; border-radius:8px; text-decoration:none; font-size:.9rem; font-weight:bold; transition:.2s; box-shadow:0 3px 10px rgba(0,0,0,0.2);}
.btn-superior:hover { background:#f1f1f1; transform:scale(1.06);}
.table-container { overflow-x:auto; }
table { width:100%; border-collapse:collapse; background:white; border-radius:15px; overflow:hidden; box-shadow:0 3px 15px rgba(0,0,0,0.15);}
th { background:#4e54c8; color:white; padding:14px; text-transform:uppercase; font-size:.8rem; letter-spacing:.5px;}
td { padding:12px; border-bottom:1px solid #eee; font-size:.95rem;}
tr:nth-child(even){ background:#f7f7f7;}
.estado-ingresado { background:#007BFF; color:white; padding:7px 12px; border-radius:20px;}
.estado-en-proceso { background:#ffca28; color:#6d5200; padding:7px 12px; border-radius:20px;}
.estado-exito { background:#28a745; color:white; padding:7px 12px; border-radius:20px;}
.estado-rechazado { background:#dc3545; color:white; padding:7px 12px; border-radius:20px;}
.pago-por-pagar { background:#ffeeba; color:#856404; padding:7px 12px; border-radius:20px; display:inline-block; margin-bottom:8px;}
.pago-pagado { background:#d4edda; color:#155724; padding:7px 12px; border-radius:20px; display:inline-block; margin-bottom:8px;}
.btn-confirmar, .btn-por-pagar, .btn-comprobante { padding:8px 16px; border-radius:12px; border:none; cursor:pointer; font-size:.9rem; font-weight:bold; transition:all .3s ease; box-shadow:0 3px 10px rgba(0,0,0,0.15);}
.btn-por-pagar { background:#ffc107; color:#6d5200;}
.btn-por-pagar:hover { background:#e0a800; transform:translateY(-2px) scale(1.05);}
.btn-confirmar { background:#28a745; color:white;}
.btn-confirmar:hover { background:#218838; transform:translateY(-2px) scale(1.05);}
.btn-comprobante { background:linear-gradient(135deg,#4e54c8,#8f94fb); color:white;}
.btn-comprobante:hover { background:linear-gradient(135deg,#6a63f7,#a1a0ff); transform:translateY(-2px) scale(1.05);}
.pago-botones { display:flex; gap:8px; flex-wrap:wrap;}
.botones { margin-top:20px; text-align:center;}
.botones a { padding:12px 20px; margin:8px; background:#4e54c8; color:white; text-decoration:none; border-radius:10px; font-size:1rem; font-weight:bold; box-shadow:0 3px 10px rgba(0,0,0,0.2); transition:.2s;}
.botones a:hover { transform:scale(1.05);}
.modal, #qrModal { display:none; position:fixed; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.6); backdrop-filter: blur(3px); z-index:9999;}
.modal-content, #qrContent { background:white; margin:12% auto; padding:20px; border-radius:15px; width:90%; max-width:350px; text-align:center; box-shadow:0 5px 20px rgba(0,0,0,0.3);}
#qrContent img { width:70%; margin-bottom:20px; }

/* NUEVO ESTILO BOTÓN PAGO REALIZADO */
.btn-pago-realizado {
    background: linear-gradient(135deg, #28a745, #218838);
    color: #fff;
    font-weight: bold;
    font-size: 1rem;
    padding: 12px 24px;
    border-radius: 12px;
    border: none;
    cursor: pointer;
    box-shadow: 0 6px 15px rgba(0,0,0,0.3);
    transition: all 0.3s ease;
    text-transform: uppercase;
}
.btn-pago-realizado:hover {
    background: linear-gradient(135deg, #218838, #1e7e34);
    transform: translateY(-2px) scale(1.05);
    box-shadow: 0 8px 20px rgba(0,0,0,0.4);
}
</style>
</head>
<body>

<header class="header">
    <div>
        <h1 class="titulo">UNLOCKSERVERPRO</h1>
        <p class="subtitulo">IMEI / SN • Rentas • Activaciones</p>
    </div>
   <div class="header-right">
    <a class="btn-superior" href="index.php">🏠 Inicio</a>
    <a class="btn-superior" href="agregar.php">➕ Nuevo Pedido</a>
    <a class="btn-superior" href="http://t.me/PedidosRealizados_Bot">🆔 Revisar Pedidos</a>
</div>
</header>

<div class="table-container">
<table>
<tr>
    <th>ID</th>
    <th>IMEI/SN</th>
    <th>Modelo</th>
    <th>Servicio</th>
    <th>Estado</th>
    <th>Pago</th>
    <th>Fecha</th>
</tr>

<?php while ($fila = $resultado->fetch_assoc()) {

switch($fila['estado']){
    case "Ingresado": $clase_estado="estado-ingresado"; break;
    case "En proceso": $clase_estado="estado-en-proceso"; break;
    case "Exito": $clase_estado="estado-exito"; break;
    case "Rechazado": $clase_estado="estado-rechazado"; break;
}

$clase_pago = ($fila['status_pago']=="Pagado")?"pago-pagado":"pago-por-pagar";

?>
<tr>
    <td><?= $fila['id'] ?></td>
    <td><?= htmlspecialchars($fila['imei_sn']) ?></td>
    <td><?= htmlspecialchars($fila['modelo']) ?></td>
    <td><?= htmlspecialchars($fila['servicio']) ?></td>
    <td><span class="<?= $clase_estado ?>"><?= $fila['estado'] ?></span></td>

    <td>
        <div><span class="<?= $clase_pago ?>"><?= $fila['status_pago'] ?></span></div>
        <div class="pago-botones">
            <?php if($fila['status_pago']=="Por Pagar"): ?>
                 <a href="comprobante.php?id=<?= $fila['id'] ?>" class="btn-comprobante">Comprobante</a>
                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id_pago" value="<?= $fila['id'] ?>">
                    <input type="hidden" name="status_pago" value="Por Pagar">
                    <button class="btn-por-pagar" name="cambiar_pago">Por Pagar</button>
                </form>

                <form method="POST" style="display:inline;">
                    <input type="hidden" name="id_pago" value="<?= $fila['id'] ?>">
                    <input type="hidden" name="status_pago" value="Pagado">
                    <button class="btn-confirmar" name="cambiar_pago">Confirmar</button>
                </form>
            <?php endif; ?>
        </div>
    </td>

    <td><?= $fila['fecha'] ?></td>
</tr>
<?php } ?>
</table>
</div>

<div class="botones">
    <a href="agregar.php">Agregar Pedido</a>
    <a href="#" onclick="abrirQR()">GENERAR QR BINANCE</a>
</div>

<!-- MODAL QR -->
<div id="qrModal">
    <div id="qrContent">
        <img src="img/binance.png">
        <button class="btn-pago-realizado" onclick="mensajeConfirmar()">PAGO REALIZADO</button>
        <p id="mensajeConfirmarText" style="display:none;color:#28a745;font-weight:bold; margin-top:15px;">✔ Pago realizado</p>
    </div>
</div>

<!-- MODAL VIP -->
<div id="vipModal" class="modal">
    <div class="modal-content">
        <h3>Zona VIP</h3>
        <p>Ingresa la contraseña</p>
        <input type="password" id="claveVIP">
        <button onclick="validarVIP()">Acceder</button>
        <p id="errorVIP" style="color:red;"></p>
    </div>
</div>

<script>
function abrirQR(){
    document.getElementById("qrModal").style.display="block";
}

function mensajeConfirmar(){
    const modal = document.getElementById("qrModal");
    const mensaje = document.getElementById("mensajeConfirmarText");

    mensaje.style.display = "block";
    mensaje.innerText = "✔ Pago realizado";

    // Cierra el modal y redirige
    setTimeout(() => {
        modal.style.display = "none";
        window.location.href = "listaactualizada.php";
    }, 2000);
}

function abrirVentanaVIP(){
    document.getElementById("vipModal").style.display="block";
}

function validarVIP(){
    let clave = document.getElementById("claveVIP").value;
    if(clave==="UNLOCKSERVERPRO06"){
        window.location="agregarproducto.php";
    } else {
        document.getElementById("errorVIP").innerHTML="Incorrecta";
    }
}
</script>

</body>
</html>
