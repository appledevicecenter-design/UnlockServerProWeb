<?php
include "conexion.php";

// Traer todos los registros
$resultado = $conexion->query("SELECT * FROM registros ORDER BY fecha DESC");
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>UNLOCKSERVERPRO - Panel de Control</title>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- FUENTE MODERNA -->
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;800&display=swap" rel="stylesheet">

<style>
/* ==================== ESTILOS BASE ==================== */
body { 
    font-family: 'Inter', sans-serif;
    margin: 0;
    padding: 20px;
    background: #edf1f7;
}

/* ==================== HEADER PREMIUM ==================== */
.header {
    background: linear-gradient(135deg, #4e54c8, #8f94fb);
    padding: 25px;
    color: white;
    border-radius: 15px;
    margin-bottom: 25px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.25);
    text-align: center;
}

.header h1 {
    margin: 0;
    font-size: 2.4rem;
    font-weight: 800;
}

.header p {
    margin-top: 5px;
    font-size: 1rem;
    opacity: 0.9;
}

/* ==================== TABLA ==================== */
.table-container {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.12);
}

th {
    background: #4e54c8;
    color: white;
    padding: 14px;
    font-size: .85rem;
    text-transform: uppercase;
    letter-spacing: .6px;
}

td {
    padding: 12px 15px;
    font-size: .95rem;
    border-bottom: 1px solid #e6e6e6;
}

tr:hover {
    background: #f6f6f6;
}

/* ==================== ESTADOS ==================== */

.estado-ingresado {
    background: #007BFF;
    color: white;
    padding: 6px 12px;
    font-weight: 600;
    border-radius: 25px;
}

.estado-en-proceso {
    background: #FFD500;
    color: #7a5d00;
    padding: 6px 12px;
    font-weight: 600;
    border-radius: 25px;
}

.estado-exito {
    background: #28a745;
    color: white;
    padding: 6px 12px;
    font-weight: 600;
    border-radius: 25px;
}

.estado-rechazado {
    background: #DC3545;
    color: white;
    padding: 6px 12px;
    font-weight: 600;
    border-radius: 25px;
}

/* ==================== PAGO ==================== */

.pago-por-pagar {
    background: #fff3cd;
    color: #856404;
    padding: 6px 12px;
    border-radius: 25px;
    font-weight: 600;
}

.pago-pagado {
    background: #d4edda;
    color: #155724;
    padding: 6px 12px;
    border-radius: 25px;
    font-weight: 600;
}

select {
    padding: 8px;
    border-radius: 6px;
    border: 1px solid #ccc;
}

/* ==================== BOTONES PRINCIPALES ==================== */
.botones {
    margin-top: 25px;
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 12px;
}

.botones a {
    padding: 12px 20px;
    background: #4e54c8;
    color: white;
    text-decoration: none;
    border-radius: 10px;
    font-weight: 600;
    box-shadow: 0 3px 10px rgba(0,0,0,0.2);
    transition: .2s;
}

.botones a:hover {
    transform: scale(1.05);
    background: #3f44b5;
}

#btnEliminar {
    background: #DC3545 !important;
}

#btnEliminar:hover {
    background: #b52b36 !important;
}

button {
    margin-top: 6px;
    padding: 8px 16px;
    background-color: #28a745;
    border-radius: 8px;
    border: none;
    color: white;
    cursor: pointer;
    font-weight: 600;
}

button:hover {
    background-color: #1f8e39;
}
</style>
</head>

<body>

<!-- ==================== HEADER ==================== -->
<div class="header">
    <h1>UNLOCKSERVERPRO</h1>
    <p>IMEI • SN • Rentas • Activaciones</p>
    

</div>



<!-- ==================== TABLA ==================== -->
<div class="table-container">
<table>
    <tr>
        <th>ID</th>
        <th>IMEI / SN</th>
        <th>Modelo</th>
        <th>Servicio</th>
        <th>Estado</th>
        <th>Pago</th>
        <th>Fecha</th>
        <th>Opciones</th>
    </tr>

<?php while ($fila = $resultado->fetch_assoc()) { 

switch($fila['estado']){
    case "Ingresado": $clase_estado="estado-ingresado"; break;
    case "En proceso": $clase_estado="estado-en-proceso"; break;
    case "Exito": $clase_estado="estado-exito"; break;
    case "Rechazado": $clase_estado="estado-rechazado"; break;
}

$clase_pago = ($fila['status_pago']=="Pagado") ? "pago-pagado" : "pago-por-pagar";
?>

<tr>
    <td><?= $fila['id']; ?></td>
    <td><?= htmlspecialchars($fila['imei_sn']); ?></td>
    <td><?= htmlspecialchars($fila['modelo']); ?></td>
    <td><?= htmlspecialchars($fila['servicio']); ?></td>

    <td><span class="<?= $clase_estado ?>"><?= $fila['estado']; ?></span></td>

    <td><span class="<?= $clase_pago ?>"><?= $fila['status_pago']; ?></span></td>

    <td><?= $fila['fecha']; ?></td>

    <td>
        <form action="update_estado.php" method="POST">
            <input type="hidden" name="id" value="<?= $fila['id']; ?>">

            <select name="estado">
                <option value="Ingresado"  <?= ($fila['estado']=="Ingresado")?"selected":"" ?>>🔵 Ingresado</option>
                <option value="En proceso" <?= ($fila['estado']=="En proceso")?"selected":"" ?>>🟡 En proceso</option>
                <option value="Exito"      <?= ($fila['estado']=="Exito")?"selected":"" ?>>🟢 Exito</option>
                <option value="Rechazado"  <?= ($fila['estado']=="Rechazado")?"selected":"" ?>>🔴 Rechazado</option>
            </select>

            <button type="submit">Actualizar</button>
        </form>

        
    
    </td>
</tr>

<?php } ?>
</table>
</div>

<!-- ==================== BOTONES ==================== -->
<div class="botones">
    <a href="factura.php"> Realizar Factura Electronica</a>
    <a href="enviar.php"> Agregar Licencias & Producto</a>
    <a href="agregarproducto.php">📦 Agregar Producto</a>
    <a href="agregar.php">➕ Agregar Pedido</a>
    <a href="listaactualizada.php">📋 Lista Actualizada</a>
    <a href="#" id="btnEliminar">🗑 Eliminar Todo</a>
</div>


<!-- ==================== SWEETALERT HACKER PRO ==================== -->
<script>
// Botón eliminar todo con animación hacker PRO++
document.getElementById("btnEliminar").addEventListener("click", function(e){
    e.preventDefault();

    Swal.fire({
        title: "⚠ BORRADO IRREVERSIBLE",
        html: "<b>¿Seguro que deseas eliminar TODOS los registros?</b>",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Sí, eliminar",
        cancelButtonText: "Cancelar",
        background: "#111",
        color: "#fff"
    }).then(r=>{
        if(!r.isConfirmed) return;

        Swal.fire({
            title: "🧨 Eliminando...",
            html: `
                <p id="msg" style="color:#00eaff;font-weight:bold;">Procesando...</p>
                <div style="width:100%;background:#000;border:1px solid #00ff9f;height:26px;border-radius:30px;overflow:hidden;">
                    <div id="bar" style="
                        height:100%;
                        width:0%;
                        text-align:center;
                        line-height:26px;
                        color:white;
                        background: linear-gradient(90deg, #00c3ff, #007bff);
                        font-weight:bold;">
                        0%
                    </div>
                </div>
            `,
            background:"#000",
            color:"#fff",
            showConfirmButton:false,
            allowOutsideClick:false,
            didOpen:()=>{
                let bar=document.getElementById("bar");
                let msg=document.getElementById("msg");

                let mensajes = [
                    "Eliminando registros...",
                    "Depurando base de datos...",
                    "Removiendo datos residuales...",
                    "Limpiando logs...",
                    "Borrado completo..."
                ];

                let progreso=0, i=0;
                let intervalo=setInterval(()=>{

                    progreso += 3;
                    bar.style.width = progreso+"%";
                    bar.textContent = progreso+"%";

                    if(progreso > (i+1)*20 && i<mensajes.length){
                        msg.textContent = mensajes[i];
                        i++;
                    }

                    if(progreso >= 100){
                        clearInterval(intervalo);
                        msg.textContent = "✔ Completado";
                        setTimeout(()=>{ window.location = "eliminar_todo.php"; }, 600);
                    }

                }, 70);
            }
        });
    });
});
</script>

</body>
</html>
