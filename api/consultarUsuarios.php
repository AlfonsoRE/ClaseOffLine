<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$stmt = $db->prepare("SELECT id,nombre,email, password, rol, status, fecha_inicio FROM usuarios");
$stmt->bind_result($id,$nombre,$emai,$password,$rol,$status,$fecha_inicio);
$stmt->execute();
$arr = array();
while($stmt->fetch()){
$arr[] = array('id' =>$id, 
'nombre' =>$nombre,
'emai' =>$emai,
'password' =>$password,
'rol' =>$rol,
'status' =>$status,
'fecha_inicio' =>$fecha_inicio
);
}
$stmt->close();
echo json_encode($arr);
?>