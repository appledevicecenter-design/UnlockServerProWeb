<?php
// Redirigir después de 2 segundos
echo "<meta http='refresh' content='0;url=listaactualizada.php'>";

// Conexión a la BD
$conexion = new mysqli("localhost", "root", "", "iphone_db");

if ($conexion->connect_error) {
    die("<div style='
        margin: 40px auto;
        max-width: 400px;
        padding: 20px;
        background:#ffdddd;
        color:#b30000;
        border:1px solid #b30000;
        border-radius:10px;
        font-family: Arial, sans-serif;
        font-size:16px;
        text-align:center;
    '>❌ Error de conexión: " . $conexion->connect_error . "</div>");
}

// Ejecuta la eliminación
$sql = "DELETE FROM usuarios";

if ($conexion->query($sql) === TRUE) {

    echo "<div style='
        margin: 40px auto;
        max-width: 400px;
        padding: 20px;
        background:#d4edda;
        color:#155724;
        border:1px solid #155724;
        border-radius:10px;
        font-family: Arial, sans-serif;
        font-size:18px;
        text-align:center;
        font-weight:bold;
    '>
    ✔️ Todos los usuarios han sido eliminados.<br><br>
    Redirigiendo...
    </div>";

} else {

    echo "<div style='
        margin: 40px auto;
        max-width: 400px;
        padding: 20px;
        background:#ffdddd;
        color:#b30000;
        border:1px solid #b30000;
        border-radius:10px;
        font-family: Arial, sans-serif;
        font-size:16px;
        text-align:center;
    '>
    ❌ Error eliminando usuarios: " . $conexion->error . "<br><br>
    Redirigiendo...
    </div>";

}

$conexion->close();
?>
