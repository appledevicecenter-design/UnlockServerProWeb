<?php
header('Content-Type: application/json');
$host="localhost"; 
$db="generador_imei"; 
$user="root"; 
$pass="";
$conn=new mysqli($host,$user,$pass,$db);
if($conn->connect_error){die(json_encode(['success'=>false,'error'=>'Error de conexión']));}

$usuario = $_GET['usuario'] ?? '';
if(!$usuario){
    echo json_encode(['success'=>false,'creditos'=>0]);
    exit;
}

$stmt = $conn->prepare("SELECT creditos FROM usuarios WHERE usuario=?");
$stmt->bind_param("s", $usuario);
$stmt->execute();
$result = $stmt->get_result();

if($row = $result->fetch_assoc()){
    echo json_encode(['success'=>true,'creditos'=>$row['creditos']]);
} else {
    echo json_encode(['success'=>true,'creditos'=>0]);
}
$conn->close();
?>