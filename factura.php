<?php
// factura.php
$mostrarFactura = false;

// Crear carpeta de facturas si no existe
if (!is_dir('facturas')) mkdir('facturas', 0777, true);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // DATOS DE EMPRESA
    $empresa = "UNLOCKSERVERPRO S.A.";
    $ruc = "1234567890";
    $web = "www.UnlockServerPro.com";

    // DATOS DE CLIENTE
    $cliente = $_POST['cliente'];

    // PRODUCTOS
    $productos  = $_POST['producto'];
    $precios    = $_POST['precio'];
    $cantidades = $_POST['cantidad'];

    // NUMERO Y FECHA
    $numero = "FE-" . date("Ymd") . "-" . rand(1000,9999);
    $fecha  = date("d/m/Y H:i");

    // CALCULAR SUBTOTAL, IVA Y TOTAL
    $subtotal = 0;
    for ($i = 0; $i < count($productos); $i++) {
        if (!empty($productos[$i]) && $precios[$i] > 0 && $cantidades[$i] > 0) {
            $subtotal += $precios[$i] * $cantidades[$i];
        }
    }
    $iva = $subtotal * 0.00;
    $total = $subtotal + $iva;

    // DATOS DE FACTURA
    $factura = [
        'empresa' => $empresa,
        'ruc' => $ruc,
        'web' => $web,
        'cliente' => $cliente,
        'productos' => $productos,
        'precios' => $precios,
        'cantidades' => $cantidades,
        'numero' => $numero,
        'fecha' => $fecha,
        'subtotal' => $subtotal,
        'iva' => $iva,
        'total' => $total
    ];

    // GUARDAR FACTURA EN JSON
    file_put_contents("facturas/$numero.json", json_encode($factura));

    // QR apunta a factura_ver.php
    $qr = urlencode("http://localhost/UnlockServerPro/factura_ver.php?id=".$numero);

    $mostrarFactura = true;
}
?>
<!DOCTYPE html>
<html lang="es">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<head>
<meta charset="UTF-8">
<title>Factura Electrónica</title>
<style>
body{margin:0;font-family:'Segoe UI',Arial;background:linear-gradient(135deg,#001f3f,#001020);}
.container{display:flex;gap:20px;padding:20px;position:relative;}
.form{width:40%;background:white;padding:20px;border-radius:10px;box-shadow:0 5px 15px rgba(0,0,0,.1);}
.form h3{margin-top:0;}
.form label{font-size:13px;font-weight:bold;}
.form input{width:95%;padding:10px;margin:5px 0 12px 0;border-radius:6px;border:1px solid #ccc;}
.form .producto{background:#f9fafb;padding:10px;border-radius:8px;margin-bottom:15px;position:relative;}
.form .producto button.remove-product{position:absolute;top:8px;right:8px;background:#ef4444;border:none;color:white;border-radius:50%;width:24px;height:24px;font-weight:bold;cursor:pointer;}
.form button.submit-btn{width:100%;padding:14px;background:#0a2cff;color:white;border:none;border-radius:8px;font-size:16px;}
.form a.btn-clear{display:block;margin-top:10px;text-align:center;padding:12px;background:#6b7280;color:white;text-decoration:none;border-radius:8px;}
.form button.add-product{background:#10b981;color:white;border:none;padding:10px 15px;font-size:14px;border-radius:8px;cursor:pointer;margin-bottom:15px;}
.factura{width:60%;display:flex;justify-content:center;}
.ticket{width:320px;background:white;padding:15px;box-shadow:0 0 10px rgba(0,0,0,.15);font-family:'Courier New',monospace;}
.center{text-align:center;}
.small{font-size:12px;}
.line{border-top:1px dashed #000;margin:8px 0;}
table{width:100%;border-collapse:collapse;}
td{padding:4px 0;font-size:13px;}
td.right{text-align:right;}
.actions{text-align:center;margin-top:10px;}
.actions button,.actions a{display:block;margin:5px auto;padding:10px;width:320px;color:white;text-decoration:none;border:none;}
.print{background:#16a34a;}
.wa{background:#22c55e;}
.tg{background:#0ea5e9;}
@media print{.form,.actions{display:none}body{background:white}}
</style>
<script>
document.addEventListener('DOMContentLoaded',function(){
    const addBtn = document.getElementById('addProductBtn');
    const productosDiv = document.getElementById('productos');

    function crearProducto(num,desc='',precio='',cantidad=''){
        const div = document.createElement('div');
        div.classList.add('producto');
        div.innerHTML = `<strong>Producto ${num}</strong>
            <label>Descripción</label>
            <input type="text" name="producto[]" required value="${desc}">
            <label>Precio</label>
            <input type="number" step="0.01" name="precio[]" required value="${precio}">
            <label>Cantidad</label>
            <input type="number" name="cantidad[]" required value="${cantidad}">
            <button type="button" class="remove-product" title="Eliminar producto">×</button>`;
        div.querySelector('.remove-product').addEventListener('click',()=>{productosDiv.removeChild(div);actualizarNumeros();});
        return div;
    }

    function actualizarNumeros(){
        const productos = productosDiv.querySelectorAll('.producto strong');
        productos.forEach((el,i)=>{el.textContent=`Producto ${i+1}`;});
    }

    addBtn.addEventListener('click',()=>{
        const numProductos = productosDiv.querySelectorAll('.producto').length+1;
        productosDiv.appendChild(crearProducto(numProductos));
    });

    if(productosDiv.children.length===0){
        productosDiv.appendChild(crearProducto(1));
    }
});
</script>
</head>
<body>

<div class="container">

<div class="form">
<form method="POST" autocomplete="off">
<h3>🧾 Nueva Factura</h3>
<label>Cliente</label>
<input type="text" name="cliente" required value="<?= isset($cliente)?htmlspecialchars($cliente):'' ?>">

<div id="productos">
<?php
if($mostrarFactura){
    for($i=0;$i<count($productos);$i++){
        $desc=htmlspecialchars($productos[$i]);
        $precio=htmlspecialchars($precios[$i]);
        $cantidad=htmlspecialchars($cantidades[$i]);
        echo "<div class='producto'>
        <strong>Producto ".($i+1)."</strong>
        <label>Descripción</label>
        <input type='text' name='producto[]' required value='{$desc}'>
        <label>Precio</label>
        <input type='number' step='0.01' name='precio[]' required value='{$precio}'>
        <label>Cantidad</label>
        <input type='number' name='cantidad[]' required value='{$cantidad}'>
        <button type='button' class='remove-product' title='Eliminar producto'>×</button>
        </div>";
    }
}
?>
</div>

<button type="button" id="addProductBtn" class="add-product">➕ Agregar producto</button>
<button type="submit" class="submit-btn">Generar Factura</button>
<a href="factura.php" class="btn-clear">🧹 Limpiar Factura</a>
</form>
</div>

<div class="factura">
<?php if($mostrarFactura): ?>
<div>
<div class="ticket">

<div class="center">
    <strong><?= $empresa ?></strong><br>
    RUC <?= $ruc ?><br>
    <?= $web ?>
</div>

<div class="line"></div>
<div class="small">
FACTURA ELECTRÓNICA<br>
Nº <?= $numero ?><br>
<?= $fecha ?><br>
Cliente: <?= htmlspecialchars($cliente) ?>
</div>

<div class="line"></div>

<table>
<?php
for($i=0;$i<count($productos);$i++){
    if(!empty($productos[$i]) && $precios[$i]>0 && $cantidades[$i]>0){
        $totalProd=$precios[$i]*$cantidades[$i];
        echo "<tr><td>".htmlspecialchars($productos[$i])."</td><td class='right'>$".number_format($totalProd,2)."</td></tr>";
    }
}
?>
</table>

<div class="line"></div>

<table>
<tr><td>Subtotal</td><td class="right">$<?= number_format($subtotal,2) ?></td></tr>
<tr><td>IVA 0%</td><td class="right">$<?= number_format($iva,2) ?></td></tr>
<tr><td><strong>TOTAL</strong></td><td class="right"><strong>$<?= number_format($total,2) ?></strong></td></tr>
</table>

<div class="line"></div>

<div class="center">
<img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=<?= $qr ?>">
</div>

<div class="center small">
Gracias por su compra
</div>

</div>

<div class="actions">
<button class="print" onclick="window.print()">🖨️ Imprimir / PDF</button>

<a class="wa" target="_blank" href="https://wa.me/?text=Factura%20<?= urlencode($numero) ?>%20Total%20$<?= number_format($total,2) ?>">WhatsApp</a>
<a class="tg" target="_blank" href="https://t.me/share/url?text=Factura%20<?= urlencode($numero) ?>">Telegram</a>
</div>
</div>
<?php endif; ?>
</div>

<script>
// Eliminar productos cargados desde PHP
document.querySelectorAll('.producto button.remove-product').forEach(btn=>{
    btn.addEventListener('click',function(){
        this.parentElement.remove();
        const productos=document.querySelectorAll('#productos .producto strong');
        productos.forEach((el,i)=>el.textContent=`Producto ${i+1}`);
    });
});


function descargarPDF(){
    const factura = document.getElementById('facturaPDF');

    if(!factura){
        alert('No se encontró la factura');
        return;
    }

    html2pdf().set({
        margin: 5,
        filename: 'Factura_<?= $numero ?>.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'mm', format: [80, 200], orientation: 'portrait' }
    }).from(factura).save();
}


</script>

</body>
</html>
