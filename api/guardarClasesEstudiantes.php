<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$obj = json_decode(file_get_contents("php://input")); 
$stmt=$db->prepare("INSERT INTO clase_estudiantes(id_clase,id_estudiante) 
 VALUES(select id from clases where codigo= ?,?)");
$stmt->bind_param('si',$obj->codigo,$obj->id_estudiante);
$stmt->execute();
$stmt->close();
echo "Registro exitoso";
?>