<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$obj = json_decode(file_get_contents("php://input"));
$stmt = $db->prepare("UPDATE usuarios SET nombre=?, email=?	where id=?");
$stmt->bind_param('sss',$obj->nombre,$obj->email,$obj->id);
$stmt->execute();
$stmt->close();
echo "Registro modificado";
?>