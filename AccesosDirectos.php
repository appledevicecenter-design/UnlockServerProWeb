<?php
// Definimos todos los accesos directos y descargas
$accesos = [
    "General" => [
        ["archivo"=>"descarga (1).png","nombre"=>"Accesos Directos (General)","tipo"=>"Acceso directo"],
    ],
    "Ajustes" => [
        ["archivo"=>"google.png","nombre"=>"Google","tipo"=>"Acceso directo"],
        ["archivo"=>"Bloqueo de pantalla.jpg","nombre"=>"Bloqueo/pantalla","tipo"=>"Acceso directo"],
        ["archivo"=>"0e475bb9b17b3fa4f94f31fba1635b8f-telephone-call-icon-logo.png","nombre"=>"Telefono","tipo"=>"Acceso directo"],
        ["archivo"=>"unnamed (2)_edited.jpg","nombre"=>"Activity Launcher","tipo"=>"Acceso directo"],
        ["archivo"=>"Google_Assistant_logo.svg.png","nombre"=>"Asistente de Google","tipo"=>"Acceso directo"],
        ["archivo"=>"unnamed.webp","nombre"=>"Accesibilidad","tipo"=>"Acceso directo"],
        ["archivo"=>"googlemaps-logo-freelogovectors.net_.png","nombre"=>"Maps","tipo"=>"Acceso directo"],
        ["archivo"=>"cambiaTelefono.webp","nombre"=>"Cambiar Telefono","tipo"=>"Acceso directo"],
    ],
    "Xiaomi" => [
        ["archivo"=>"unnamed.png","nombre"=>"Shareme","tipo"=>"Acceso directo"],
        ["archivo"=>"get-app.png","nombre"=>"GetApp","tipo"=>"Acceso directo"],
        ["archivo"=>"b39b2799929ed54fd5ff7f8a514162835c0b3580889ba05e5d2c848e42a0cdfc_200.webp","nombre"=>"Seguridad","tipo"=>"Acceso directo"],
        ["archivo"=>"Activity Launcher.png","nombre"=>"A-L de GetApp","tipo"=>"Acceso directo"],
        ["archivo"=>"Imagen 1.png","nombre"=>"WA de GetApp","tipo"=>"Acceso directo"],
    ],
    "Motorola" => [
        ["archivo"=>"moto.png","nombre"=>"Moto","tipo"=>"Acceso directo"],
        ["archivo"=>"moto-secure.png","nombre"=>"Moto Secure","tipo"=>"Acceso directo"],
        ["archivo"=>"unnamed (1).webp","nombre"=>"Hello You","tipo"=>"Acceso directo"],
    ],
    "Descargas" => [
        ["archivo"=>"cambiaTelefono.webp","nombre"=>"Cambiar Telefono","tipo"=>"Descargar"],
        ["archivo"=>"images.png","nombre"=>"Palm Store","tipo"=>"Descargar"],
        ["archivo"=>"QuickSortCutMaker_edited_edited.jpg","nombre"=>"QuickShortcutMaker","tipo"=>"Descargar"],
        ["archivo"=>"google.png","nombre"=>"Google Account","tipo"=>"Descargar"],
        ["archivo"=>"unnamed (2)_edited.jpg","nombre"=>"Activity Launcher","tipo"=>"Descargar"],
        ["archivo"=>"unnamed.png","nombre"=>"FRP Bypass","tipo"=>"Descargar"],
        ["archivo"=>"unnamed.png","nombre"=>"Shareme","tipo"=>"Descargar"],
    ],
];

// Carpeta donde están los archivos
$carpeta = "files"; // crea esta carpeta dentro de tu proyecto y coloca todas las imágenes/archivos
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Accesos Directos</title>
<style>
body{
    background:#0f172a;
    font-family:Segoe UI, Arial;
    color:#e5e7eb;
    margin:0;
}
header{
    background:#020617;
    padding:16px;
    text-align:center;
    font-size:24px;
    font-weight:bold;
}
.section{
    padding:20px;
}
.section h2{
    margin:0 0 12px;
    font-size:20px;
    border-bottom:1px solid #334155;
    padding-bottom:6px;
}
.grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(140px,1fr));
    gap:16px;
}
.card{
    background:#1e293b;
    border-radius:16px;
    padding:12px;
    text-align:center;
    transition: transform 0.2s, box-shadow 0.2s;
}
.card:hover{
    transform: translateY(-4px);
    box-shadow: 0 6px 12px rgba(0,0,0,0.4);
}
.card img{
    width:64px;
    height:64px;
    object-fit:contain;
}
.name{
    font-size:14px;
    margin-top:6px;
    font-weight:600;
}
.type{
    font-size:11px;
    color:#94a3b8;
    margin-top:2px;
}
.btn{
    display:block;
    margin-top:8px;
    padding:6px;
    border-radius:6px;
    text-decoration:none;
    font-size:13px;
    color:white;
}
.btn.open{
    background:#6366f1;
}
.btn.download{
    background:#22c55e;
}
.btn:hover{
    opacity:.9;
}
</style>
</head>
<body>
<header>🔓 Accesos Directos</header>

<?php foreach ($accesos as $categoria => $items): ?>
<div class="section">
<h2><?= htmlspecialchars($categoria) ?></h2>
<div class="grid">
    <?php foreach ($items as $item): 
        $ruta = $carpeta . "/" . $item['archivo'];
        $tipo = $item['tipo'];
    ?>
    <div class="card">
        <img src="<?= htmlspecialchars($ruta) ?>" alt="<?= htmlspecialchars($item['nombre']) ?>">
        <div class="name"><?= htmlspecialchars($item['nombre']) ?></div>
        <div class="type"><?= htmlspecialchars($tipo) ?></div>
        <?php if($tipo == "Descargar"): ?>
            <a class="btn download" href="<?= htmlspecialchars($ruta) ?>" download>⬇ Descargar</a>
        <?php else: ?>
            <a class="btn open" href="<?= htmlspecialchars($ruta) ?>">Abrir</a>
        <?php endif; ?>
    </div>
    <?php endforeach; ?>
</div>
</div>
<?php endforeach; ?>

</body>
</html>
