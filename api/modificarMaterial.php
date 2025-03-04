<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$obj = json_decode(file_get_contents("php://input"));
$stmt = $db->prepare("UPDATE material SET titulo=?, descripcion=? WHERE id=?");
$stmt->bind_param('ssi', $obj->titulo,$obj->descripcion, $obj->id);
$stmt->execute();
$stmt->close();
echo "Registro modificado";
?>