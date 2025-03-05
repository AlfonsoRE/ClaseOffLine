<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$obj = json_decode(file_get_contents("php://input")); 
$stmt=$db->prepare("INSERT INTO anuncios(id_clase,mensaje,fecha) 
 VALUES(?,?,NOW())");
$stmt->bind_param('ss',$obj->id_clase,$obj->mensaje);
$stmt->execute();
$stmt->close();
echo "Registro exitoso";
?>