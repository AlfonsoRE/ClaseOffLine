<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$obj = json_decode(file_get_contents("php://input")); 
$stmt=$db->prepare("INSERT INTO material(titulo,descripcion,id_tema) 
 VALUES(?,?,?)");
$stmt->bind_param('ssi',$obj->titulo,$obj->descripcion,$obj->id_tema);
$stmt->execute();
$stmt->close();
echo "Registro exitoso"; 
?>
