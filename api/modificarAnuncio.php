<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$obj = json_decode(file_get_contents("php://input"));
$stmt = $db->prepare("UPDATE anuncios SET id_clase=?, mensaje=?, id_usuario=? where id=?");
$stmt->bind_param('isii',$obj->id_clase,$obj->mensaje,$obj->id_usuario,$obj->id);
$stmt->execute();
$stmt->close();
echo "Registro modificado";
?>