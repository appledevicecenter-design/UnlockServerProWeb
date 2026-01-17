<?php
$resultados = [];

/* LIMPIAR */
if (isset($_POST['limpiar'])) {
    if (is_dir("convertidas")) {
        foreach (glob("convertidas/*") as $file) {
            unlink($file);
        }
    }
    $resultados = [];
}

/* CONVERTIR */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_FILES['imagenes']) && !isset($_POST['limpiar'])) {

    $formato = strtolower($_POST['formato'] ?? 'jpg');
    $calidad = intval($_POST['calidad'] ?? 90);

    if (!is_dir("convertidas")) {
        mkdir("convertidas", 0777, true);
    }

    foreach ($_FILES['imagenes']['tmp_name'] as $i => $tmp) {

        if (!is_uploaded_file($tmp)) continue;

        $nombre = pathinfo($_FILES['imagenes']['name'][$i], PATHINFO_FILENAME);
        $destino = "convertidas/" . uniqid() . "_" . $nombre . "." . $formato;

        $info = getimagesize($tmp);
        if (!$info) continue;

        switch ($info[2]) {
            case IMAGETYPE_JPEG: $img = imagecreatefromjpeg($tmp); break;
            case IMAGETYPE_PNG: $img = imagecreatefrompng($tmp); break;
            case IMAGETYPE_GIF: $img = imagecreatefromgif($tmp); break;
            case IMAGETYPE_BMP: $img = imagecreatefrombmp($tmp); break;
            case IMAGETYPE_WEBP: $img = imagecreatefromwebp($tmp); break;
            default: continue 2; // formato no soportado
        }

        switch ($formato) {
            case 'jpg':
            case 'jpeg':
                imagejpeg($img, $destino, $calidad);
                break;
            case 'png':
                imagepng($img, $destino);
                break;
            case 'gif':
                imagegif($img, $destino);
                break;
            case 'bmp':
                imagebmp($img, $destino);
                break;
            case 'webp':
                imagewebp($img, $destino, $calidad);
                break;
            default:
                imagedestroy($img);
                continue 2;
        }

        imagedestroy($img);
        $resultados[] = $destino;
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Image Converter</title>
<style>
body {background:#0f172a;font-family:Segoe UI;color:#e5e7eb;margin:0;}
header {padding:20px;background:#020617;text-align:center;font-size:22px;}
.container {max-width:1000px;margin:40px auto;}
.card {background:#1e293b;padding:30px;border-radius:14px;}
.grid {display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:15px;margin-top:20px;}
input, select, button {width:100%;padding:12px;margin-top:10px;background:#020617;color:white;border:none;border-radius:6px;}
button {background:#6366f1;font-size:16px;cursor:pointer;}
button:hover {opacity:.9}
.preview img {width:100%;border-radius:8px;}
.download-btn {display:block;margin-top:8px;padding:10px;background:#22c55e;color:#022c22;text-align:center;font-weight:600;border-radius:6px;text-decoration:none;}
.download-btn:hover {background:#16a34a;color:white;}
.clear-btn {background:#ef4444;}
.clear-btn:hover {background:#dc2626;}
</style>
</head>
<body>
<header>🧠 Image Converter </header>
<div class="container">
<div class="card">
<form method="post" enctype="multipart/form-data">
<label>📂 Seleccionar imágenes</label>
<input type="file" name="imagenes[]" multiple required>
<label>🔄 Convertir a formato</label>
<select name="formato">
<option value="jpg">JPG</option>
<option value="png">PNG</option>
<option value="gif">GIF</option>
<option value="bmp">BMP</option>
<option value="webp">WEBP</option>
</select>
<label>🎚 Calidad (JPG / WEBP)</label>
<input type="range" name="calidad" min="40" max="100" value="90">
<br><br>
<button type="submit">🚀 Convertir</button>
<button type="submit" name="limpiar" class="clear-btn">🧹 Limpiar</button>
</form>

<?php if (!empty($resultados)): ?>
<h3>✅ Resultados</h3>
<div class="grid">
<?php foreach ($resultados as $img): ?>
<div class="preview">
<img src="<?= $img ?>">
<a class="download-btn" href="<?= $img ?>" download>⬇ Descargar</a>
</div>
<?php endforeach; ?>
</div>
<?php endif; ?>

</div>
</div>
</body>
</html>
