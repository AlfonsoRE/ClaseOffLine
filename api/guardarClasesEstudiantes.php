<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$obj = json_decode(file_get_contents("php://input")); 
$stmt=$db->prepare("INSERT INTO clase_estudiantes(id_clase,id_estudiante,status) 
 VALUES(?,?,?)");
$stmt->bind_param('iis',$obj->id_clase,$obj->id_estudiante,$obj->status);
$stmt->execute();
$stmt->close();
echo "Registro exitoso";
?>