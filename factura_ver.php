<?php
// factura_ver.php

// Verificar que se haya recibido el ID de la factura
if (!isset($_GET['id'])) {
    die("Factura no encontrada.");
}

$id = $_GET['id'];
$archivo = "facturas/$id.json";

// Verificar que el archivo exista
if (!file_exists($archivo)) {
    die("Factura no encontrada.");
}

// Leer los datos de la factura
$datos = json_decode(file_get_contents($archivo), true);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Factura <?= htmlspecialchars($datos['numero']) ?></title>
<style>
body {
    background:#f2f4f8;
    font-family:'Courier New', monospace;
    display:flex;
    justify-content:center;
    padding:20px;
}
.ticket {
    width:320px;
    background:white;
    padding:15px;
    box-shadow:0 0 10px rgba(0,0,0,.15);
}
.center { text-align:center; }
.line { border-top:1px dashed #000; margin:8px 0; }
table { width:100%; border-collapse:collapse; }
td { padding:4px 0; font-size:13px; }
td.right { text-align:right; }
</style>
</head>
<body>
<div class="ticket">

<div class="center">
    <strong><?= htmlspecialchars($datos['empresa']) ?></strong><br>
    RUC <?= htmlspecialchars($datos['ruc']) ?><br>
    <?= htmlspecialchars($datos['web']) ?>
</div>

<div class="line"></div>

<div>
    <strong>FACTURA ELECTRÓNICA</strong><br>
    Nº <?= htmlspecialchars($datos['numero']) ?><br>
    <?= htmlspecialchars($datos['fecha']) ?><br>
    Cliente: <?= htmlspecialchars($datos['cliente']) ?>
</div>

<div class="line"></div>

<table>
<?php
for ($i = 0; $i < count($datos['productos']); $i++) {
    $totalProd = $datos['precios'][$i] * $datos['cantidades'][$i];
    echo "<tr>
            <td>".htmlspecialchars($datos['productos'][$i])."</td>
            <td class='right'>$".number_format($totalProd,2)."</td>
          </tr>";
}
?>
</table>

<div class="line"></div>

<table>
<tr><td>Subtotal</td><td class="right">$<?= number_format($datos['subtotal'],2) ?></td></tr>
<tr><td>IVA 12%</td><td class="right">$<?= number_format($datos['iva'],2) ?></td></tr>
<tr><td><strong>TOTAL</strong></td><td class="right"><strong>$<?= number_format($datos['total'],2) ?></strong></td></tr>
</table>

<div class="line"></div>

<div class="center">
    <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?= urlencode("http://localhost/UnlockServerPro/factura_ver.php?id=".$datos['numero']) ?>">
</div>

<div class="center" style="font-size:12px;margin-top:8px;">
    Gracias por su compra
</div>

</div>
</body>
</html>
