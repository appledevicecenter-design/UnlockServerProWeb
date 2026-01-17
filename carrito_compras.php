<?php
session_start();

/* ===== CONEXIÓN ===== */
$conexion = new mysqli("localhost", "root", "", "iphone_db");
if ($conexion->connect_error) die("Error al conectar con la base de datos");

/* ===== INICIAR CARRITO ===== */
if (!isset($_SESSION['carrito'])) $_SESSION['carrito'] = [];

/* ===== PRODUCTOS REALES ===== */
if (!isset($_SESSION['reales'])) {
    $_SESSION['reales'] = [
        ['nombre'=>'iPhone 14','precio'=>799.99,'imagen'=>'iphone14.jpg'],
        ['nombre'=>'iPhone 14 Pro','precio'=>999.99,'imagen'=>'iphone14pro.jpg'],
        ['nombre'=>'iPhone 13','precio'=>699.99,'imagen'=>'iphone13.jpg'],
        ['nombre'=>'iPhone SE','precio'=>429.99,'imagen'=>'iphonese.jpg'],
        ['nombre'=>'Apple Watch Series 8','precio'=>399.99,'imagen'=>'watch8.jpg'],
        ['nombre'=>'AirPods Pro','precio'=>249.99,'imagen'=>'airpodspro.jpg'],
        ['nombre'=>'Apple Pencil','precio'=>129.99,'imagen'=>'applepencil.jpg'],
        ['nombre'=>'MagSafe Charger','precio'=>39.99,'imagen'=>'magsafe.jpg'],
        ['nombre'=>'iPhone Case','precio'=>49.99,'imagen'=>'iphonecase.jpg'],
        ['nombre'=>'iPad Air','precio'=>599.99,'imagen'=>'ipadair.jpg']
    ];
}
$reales = &$_SESSION['reales'];

/* ===== BÚSQUEDA DE PRODUCTOS REALES ===== */
$buscar_real = "";
$filtrados_reales = $reales;
if(isset($_GET['buscar_reales'])){
    $buscar_real = trim($_GET['buscar_reales']);
    $filtrados_reales = array_filter($reales, function($p) use($buscar_real){
        return strpos(strtolower($p['nombre']), strtolower($buscar_real)) !== false;
    });
}

/* ===== PRODUCTOS DB ===== */
$buscar = "";
if(isset($_GET['buscar'])){
    $buscar = trim($_GET['buscar']);
    $stmt = $conexion->prepare("SELECT * FROM productos WHERE nombre LIKE ? ORDER BY id DESC");
    $like = "%".$buscar."%";
    $stmt->bind_param("s", $like);
    $stmt->execute();
    $productos = $stmt->get_result();
} else {
    $productos = $conexion->query("SELECT * FROM productos ORDER BY id DESC");
}

/* ===== AGREGAR AL CARRITO ===== */
if (isset($_GET['add'])) {
    $id = intval($_GET['add']);
    $stmt = $conexion->prepare("SELECT * FROM productos WHERE id=? LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $p = $stmt->get_result()->fetch_assoc();
    if ($p) {
        if (isset($_SESSION['carrito'][$id])) {
            $_SESSION['carrito'][$id]['cantidad']++;
        } else {
            $_SESSION['carrito'][$id] = [
                'nombre' => $p['nombre'],
                'precio' => $p['precio'],
                'cantidad' => 1
            ];
        }
    }
}

if (isset($_GET['add_real'])) {
    $index = intval($_GET['add_real']);
    if (isset($reales[$index])) {
        $p = $reales[$index];
        $id = "real_$index";
        if (isset($_SESSION['carrito'][$id])) {
            $_SESSION['carrito'][$id]['cantidad']++;
        } else {
            $_SESSION['carrito'][$id] = [
                'nombre' => $p['nombre'],
                'precio' => $p['precio'],
                'cantidad' => 1
            ];
        }
    }
}

/* ===== CONTROLES DEL CARRITO ===== */
if (isset($_GET['accion'], $_GET['id'])) {
    $id = $_GET['id'];
    if (isset($_SESSION['carrito'][$id])) {
        if ($_GET['accion'] == "mas") $_SESSION['carrito'][$id]['cantidad']++;
        if ($_GET['accion'] == "menos" && $_SESSION['carrito'][$id]['cantidad'] > 1)
            $_SESSION['carrito'][$id]['cantidad']--;
    }
}

if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    unset($_SESSION['carrito'][$id]);
}

if (isset($_GET['vaciar'])) {
    $_SESSION['carrito'] = [];
}

/* ===== VACIAR PRODUCTOS ===== */
if(isset($_GET['vaciar_db'])){
    $conexion->query("DELETE FROM productos");
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

if(isset($_GET['vaciar_reales'])){
    $_SESSION['reales'] = [];
    $reales = &$_SESSION['reales'];
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

/* ===== AGREGAR PRODUCTO NUEVO ===== */
$mensaje = '';
if (isset($_POST['guardar'])) {
    $nombre = trim($_POST['nombre']);
    $precio = floatval($_POST['precio']);
    $imagen = '';

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
        $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
        $imagen = uniqid() . "." . $ext;
        move_uploaded_file($_FILES['imagen']['tmp_name'], "imagenes/$imagen");
    }

    if ($nombre && $precio && $imagen) {
        $stmt = $conexion->prepare("INSERT INTO productos(nombre, precio, imagen) VALUES (?, ?, ?)");
        $stmt->bind_param("sds", $nombre, $precio, $imagen);
        if ($stmt->execute()) $mensaje = "Producto agregado correctamente a la DB";
        else $mensaje = "Error al agregar el producto a la DB";
    } else {
        $mensaje = "Completa todos los campos";
    }
}

/* ===== AGREGAR PRODUCTO REAL NUEVO ===== */
$mensaje_real = '';
if (isset($_POST['guardar_real'])) {
    $nombre = trim($_POST['nombre_real']);
    $precio = floatval($_POST['precio_real']);
    $imagen = '';

    if (isset($_FILES['imagen_real']) && $_FILES['imagen_real']['error'] == 0) {
        $ext = pathinfo($_FILES['imagen_real']['name'], PATHINFO_EXTENSION);
        $imagen = uniqid() . "." . $ext;
        move_uploaded_file($_FILES['imagen_real']['tmp_name'], "imagenes/$imagen");
    }

    if ($nombre && $precio && $imagen) {
        $reales[] = ['nombre'=>$nombre, 'precio'=>$precio, 'imagen'=>$imagen];
        $mensaje_real = "Producto real agregado correctamente";
    } else {
        $mensaje_real = "Completa todos los campos";
    }
}

/* ===== ELIMINAR PRODUCTOS ===== */
if(isset($_GET['eliminar_db'])){
    $id = intval($_GET['eliminar_db']);
    $conexion->query("DELETE FROM productos WHERE id=$id");
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}

if(isset($_GET['eliminar_real'])){
    $index = intval($_GET['eliminar_real']);
    unset($reales[$index]);
    $_SESSION['reales'] = array_values($reales);
}

/* ===== MENSAJES FLASH ===== */
$mensaje_carrito = '';
if(isset($_GET['add_real'])){
    $mensaje_carrito = $reales[intval($_GET['add_real'])]['nombre'] . " agregado al carrito!";
}
if(isset($_GET['add'])){
    $stmt = $conexion->prepare("SELECT * FROM productos WHERE id=? LIMIT 1");
    $stmt->bind_param("i", $_GET['add']);
    $stmt->execute();
    $p = $stmt->get_result()->fetch_assoc();
    if($p) $mensaje_carrito = $p['nombre']." agregado al carrito!";
}
if(isset($_GET['eliminar']) || isset($_GET['eliminar_real']) || isset($_GET['eliminar_db'])){
    $mensaje_carrito = "Producto eliminado del carrito.";
}
if(isset($_GET['vaciar']) || isset($_GET['vaciar_db']) || isset($_GET['vaciar_reales'])){
    $mensaje_carrito = "Se han vaciado los productos.";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>🛒 Tienda PRO Mejorada</title>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
<style>
/* ===== BODY Y NAVBAR ===== */
body{margin:0;font-family:'Inter',sans-serif;background:#f0f2f7;}
.navbar{display:flex;gap:20px;padding:15px;background:#2563eb;color:#fff;position:sticky;top:0;z-index:100;border-bottom:2px solid #1e40af;}
.navbar div{cursor:pointer;padding:10px 20px;border-radius:8px;transition:.2s;}
.navbar div.active, .navbar div:hover{background:#1e40af;}
.container{max-width:1400px;margin:20px auto;}
.tab-content{display:none;}
.tab-content.active{display:block;}
.productos{display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:20px;}
.card{text-align:center;padding:20px;border-radius:16px;box-shadow:0 8px 20px rgba(0,0,0,.08);background:#fff;transition:.3s;}
.card:hover{transform:translateY(-6px);}
.card img{height:140px;object-fit:contain;margin-bottom:10px;}
.precio{color:#16a34a;font-weight:700;margin:8px 0;}
.card a{display:inline-block;background:#2563eb;color:#fff;padding:8px 14px;border-radius:8px;text-decoration:none;margin:4px 2px;transition:.2s;}
.card a:hover{background:#1e40af;transform:scale(1.05);}
.delete-btn{background:#dc2626;padding:6px 12px;color:#fff;border-radius:8px;text-decoration:none;display:inline-block;margin-top:6px;transition:transform .2s;}
.delete-btn:hover{opacity:.85;transform:scale(1.05);}

/* ===== FORMULARIOS ===== */
form{margin-bottom:20px;display:flex;flex-direction:column;gap:15px;background:#fff;padding:20px;border-radius:16px;box-shadow:0 8px 20px rgba(0,0,0,.08);}
form input[type=text], form input[type=number], form input[type=file]{padding:12px 14px;border-radius:12px;border:1px solid #ccc;font-size:1rem;transition: all .2s;}
form input[type=text]:focus, form input[type=number]:focus, form input[type=file]:focus{outline:none;border-color:#2563eb;box-shadow:0 0 10px rgba(37,99,235,.3);}
form button{background:#2563eb;color:#fff;padding:14px;border:none;border-radius:12px;font-weight:bold;cursor:pointer;font-size:1rem;transition:.2s;}
form button:hover{background:#1e40af;transform:scale(1.03);}

/* ===== CARRITO ===== */
#carrito .item{display:flex;justify-content:space-between;align-items:center;padding:16px 20px;border-radius:12px;background:#fff;box-shadow:0 5px 15px rgba(0,0,0,.05);margin-bottom:12px;transition:.2s;}
#carrito .item:hover{transform:translateY(-3px);box-shadow:0 8px 20px rgba(0,0,0,.1);}
#carrito .ctrl a{padding:8px 12px;border-radius:8px;color:#fff;text-decoration:none;font-weight:bold;margin-left:4px;transition:.2s;}
#carrito .ctrl .mas{background:#16a34a;}
#carrito .ctrl .menos{background:#64748b;}
#carrito .ctrl .del{background:#dc2626;}
#carrito .ctrl a:hover{opacity:.85;transform:scale(1.1);}
.total{text-align:right;font-size:1.3rem;font-weight:bold;margin-top:10px;}
.checkout,.factura{margin-top:10px;color:#fff;padding:12px;border-radius:12px;text-align:center;font-weight:bold;cursor:pointer;display:block;transition:.2s;}
.checkout{background:#16a34a;}
.checkout:hover{background:#15803d;}
.factura{background:#2563eb;}
.factura:hover{background:#1e40af;}
.vaciar-carrito{display: inline-block;margin:10px 0;padding:12px 20px;background: linear-gradient(135deg,#dc2626,#b91c1c);color:#fff;font-weight:bold;text-align:center;border-radius:12px;text-decoration:none;transition:all .3s;}
.vaciar-carrito:hover{transform: scale(1.05);}

/* ===== RESPONSIVE ===== */
@media(max-width:900px){.productos{grid-template-columns:1fr;}#carrito .item{flex-direction:column;align-items:flex-start;}#carrito .ctrl{margin-top:10px;}}
</style>
</head>
<body>

<?php if($mensaje_carrito): ?>
<script>
Swal.fire({icon: 'success',title: '¡Éxito!',text: '<?= $mensaje_carrito ?>',timer: 2000,showConfirmButton: false});
</script>
<?php endif; ?>

<div class="navbar">
<div class="tab-link active" data-tab="reales">Productos Reales</div>
<div class="tab-link" data-tab="db">Productos DB</div>
<div class="tab-link" data-tab="agregar_real">Agregar Producto Real</div>
<div class="tab-link" data-tab="agregar">Agregar Producto DB</div>
<div class="tab-link" data-tab="carrito">Carrito (<?= count($_SESSION['carrito']) ?>)</div>
</div>

<div class="container">

<!-- PRODUCTOS REALES -->
<div class="tab-content active" id="reales">
<h2>Productos Reales</h2>
<a href="#" onclick="confirmVaciar('reales')" class="vaciar-carrito" style="background:#f97316;">Vaciar productos reales</a>
<form method="get" style="margin-bottom:20px;display:flex;gap:10px;">
    <input type="text" name="buscar_reales" placeholder="Buscar producto real..." value="<?= htmlspecialchars($buscar_real) ?>" style="flex:1;">
    <button type="submit">Buscar</button>
</form>
<div class="productos">
<?php foreach($filtrados_reales as $index => $p): ?>
<div class="card">
    <img src="imagenes/<?= $p['imagen'] ?>" alt="<?= htmlspecialchars($p['nombre']) ?>">
    <h4><?= htmlspecialchars($p['nombre']) ?></h4>
    <div class="precio">$<?= number_format($p['precio'],2) ?></div>
    <a href="?add_real=<?= $index ?>">Agregar al carrito</a>
    <a href="?eliminar_real=<?= $index ?>" class="delete-btn">Eliminar Producto Real</a>
</div>
<?php endforeach; ?>
<?php if(empty($filtrados_reales)) echo "<p style='color:#777'>No se encontraron productos</p>"; ?>
</div>
</div>

<!-- PRODUCTOS DB -->
<div class="tab-content" id="db">
<h2>Productos DB</h2>
<a href="#" onclick="confirmVaciar('db')" class="vaciar-carrito" style="background:#f97316;">Vaciar productos DB</a>
<form method="get" style="margin-bottom:20px;display:flex;gap:10px;">
    <input type="text" name="buscar" placeholder="Buscar producto..." value="<?= htmlspecialchars($buscar) ?>" style="flex:1;">
    <button type="submit">Buscar</button>
</form>
<div class="productos">
<?php if($productos->num_rows == 0): ?>
<p style="color:#777">No se encontraron productos</p>
<?php else: ?>
<?php while($p=$productos->fetch_assoc()): ?>
<div class="card">
    <img src="imagenes/<?= htmlspecialchars($p['imagen']) ?>" alt="<?= htmlspecialchars($p['nombre']) ?>">
    <h4><?= htmlspecialchars($p['nombre']) ?></h4>
    <div class="precio">$<?= number_format($p['precio'],2) ?></div>
    <a href="?add=<?= $p['id'] ?>">Agregar al carrito</a>
    <a href="?eliminar_db=<?= $p['id'] ?>" class="delete-btn">Eliminar de DB</a>
</div>
<?php endwhile; ?>
<?php endif; ?>
</div>
</div>

<!-- AGREGAR PRODUCTO REAL -->
<div class="tab-content" id="agregar_real">
<h2>Agregar Producto Real</h2>
<form method="post" enctype="multipart/form-data">
    <input type="text" name="nombre_real" placeholder="Nombre del producto real" required>
    <input type="number" step="0.01" name="precio_real" placeholder="Precio" required>
    <input type="file" name="imagen_real" accept="image/*" required>
    <button type="submit" name="guardar_real">Agregar Producto Real</button>
</form>
</div>

<!-- AGREGAR PRODUCTO DB -->
<div class="tab-content" id="agregar">
<h2>Agregar Producto DB</h2>
<form method="post" enctype="multipart/form-data">
    <input type="text" name="nombre" placeholder="Nombre del producto" required>
    <input type="number" step="0.01" name="precio" placeholder="Precio" required>
    <input type="file" name="imagen" accept="image/*" required>
    <button type="submit" name="guardar">Agregar Producto DB</button>
</form>
</div>

<!-- CARRITO -->
<div class="tab-content" id="carrito">
<h2>Tu Carrito</h2>
<?php if(empty($_SESSION['carrito'])): ?>
<p style="color:#777">Carrito vacío 🛒</p>
<?php else: 
$total=0;
foreach($_SESSION['carrito'] as $id=>$c):
$subtotal = $c['precio']*$c['cantidad'];
$total += $subtotal;
?>
<div class="item">
    <div>
        <h4><?= htmlspecialchars($c['nombre']) ?></h4>
        <div>Cantidad: <?= $c['cantidad'] ?> | Precio: $<?= number_format($c['precio'],2) ?> | Subtotal: $<?= number_format($subtotal,2) ?></div>
    </div>
    <div class="ctrl">
        <a href="?accion=mas&id=<?= $id ?>" class="mas">+</a>
        <a href="?accion=menos&id=<?= $id ?>" class="menos">-</a>
        <a href="?eliminar=<?= $id ?>" class="del">Eliminar</a>
    </div>
</div>
<?php endforeach; ?>
<div class="total">Total: $<?= number_format($total,2) ?></div>
<a href="?vaciar" class="vaciar-carrito">Vaciar Carrito</a>
<a href="#" class="checkout">Checkout</a>
<a href="#" class="factura">Generar Factura</a>
<?php endif; ?>
</div>

</div>

<script>
/* ===== TABS ===== */
const tabs = document.querySelectorAll('.tab-link');
const contents = document.querySelectorAll('.tab-content');
tabs.forEach(tab=>{
    tab.addEventListener('click',()=>{
        tabs.forEach(t=>t.classList.remove('active'));
        tab.classList.add('active');
        contents.forEach(c=>c.classList.remove('active'));
        document.getElementById(tab.dataset.tab).classList.add('active');
    });
});

/* ===== CONFIRMAR VACIAR ===== */
function confirmVaciar(tipo){
    Swal.fire({
        title: '¿Estás seguro?',
        text: "Esto eliminará todos los productos "+tipo,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Sí, vaciar!'
    }).then((result)=>{
        if(result.isConfirmed){
            if(tipo=='db') window.location='?vaciar_db';
            if(tipo=='reales') window.location='?vaciar_reales';
        }
    });
}
</script>

</body>
</html>
