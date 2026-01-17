<?php
$carpeta = "."; // La carpeta actual (UnlockServerPro)
$resultados = [];

// Obtener todos los archivos .exe de la carpeta
if (is_dir($carpeta)) {
    $archivos = scandir($carpeta);
    foreach ($archivos as $archivo) {
        if ($archivo === '.' || $archivo === '..') continue;
        if (is_file($carpeta . "/" . $archivo) && strtolower(pathinfo($archivo, PATHINFO_EXTENSION)) === 'exe') {
            $resultados[] = $archivo;
        }
    }
}

// Descargar archivo
if (isset($_GET['download'])) {
    $archivo = basename($_GET['download']); // Seguridad: evitar rutas maliciosas
    $ruta = $carpeta . "/" . $archivo;

    if (file_exists($ruta) && strtolower(pathinfo($ruta, PATHINFO_EXTENSION)) === 'exe') {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $archivo . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($ruta));
        readfile($ruta);
        exit;
    } else {
        die("❌ El archivo no existe o no es un EXE.");
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Instalador Windows 10</title>
<style>
body { font-family:Segoe UI; background:#0f172a; color:#e5e7eb; text-align:center; padding:50px; }
h1 { margin-bottom:20px; }
.container { max-width:800px; margin:0 auto; text-align:left; }
.installer {
    display:flex; justify-content:space-between; align-items:center; 
    background:#1e293b; padding:15px; margin:10px 0; border-radius:8px;
}
.installer a.button {
    padding:10px 20px; background:#6366f1; color:white; text-decoration:none; border-radius:6px;
}
.installer a.button:hover { background:#4f46e5; }
.size { color:#9ca3af; font-size:14px; }
</style>
</head>
<body>
<h1>Instaladores (.exe) en UnlockServerPro</h1>
<p>Haz clic en el archivo que quieres descargar:</p>

<div class="container">
<?php if ($resultados): ?>
    <?php foreach ($resultados as $archivo): 
        $ruta = $carpeta . "/" . $archivo;
        $tam = round(filesize($ruta) / 1024 / 1024, 2); // Tamaño en MB
    ?>
        <div class="installer">
            <div>
                <strong><?= htmlspecialchars($archivo) ?></strong><br>
                <span class="size"><?= $tam ?> MB</span>
            </div>
            <a class="button" href="?download=<?= urlencode($archivo) ?>">⬇ Descargar</a>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>❌ No se encontraron archivos .exe en la carpeta.</p>
<?php endif; ?>
</div>

</body>
</html>
