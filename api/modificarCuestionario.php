<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));
$stmt = $db->prepare("UPDATE cuestionarios SET id_tema=?, titulo=?, descripcion=?, id_clase=? WHERE id=?");
$stmt->bind_param('isssi', $obj->id_tema, $obj->titulo, $obj->descripcion, $obj->id_clase, $obj->id);
$stmt->execute();
$stmt->close();
echo "Registro modificado";
?>