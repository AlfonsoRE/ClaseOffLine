<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$obj = json_decode(file_get_contents("php://input")); 
$stmt=$db->prepare("INSERT INTO clases(nombre,materia,descripcion,codigo,id_usuario) 
 VALUES(?,?,?,?,?)");
$stmt->bind_param('ssssi',$obj->nombre,$obj->materia,$obj->descripcion,$obj->codigo,$obj->id_usuario);
$stmt->execute();
$stmt->close();
echo "Registro exitoso";
?>
