<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$obj = json_decode(file_get_contents("php://input")); 
$stmt=$db->prepare("INSERT INTO anuncios(id_clase,mensaje,id_usuario) 
 VALUES(?,?,?)");
$stmt->bind_param('isi',$obj->id_clase,$obj->mensaje,$obj->id_usuario);
$stmt->execute();
$id_generado = $db->insert_id;
$stmt->close();
echo $id_generado;
?>