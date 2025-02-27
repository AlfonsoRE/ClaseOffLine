<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$obj = json_decode(file_get_contents("php://input"));
$stmt = $db->prepare("UPDATE clases SET nombre=?, materia=?, descripcion=?, codigo=? WHERE id=?");
$stmt->bind_param('ssssi', $obj->nombre, $obj->materia, $obj->descripcion, $obj->codigo, $obj->id);
$stmt->execute();
$stmt->close();
echo "Registro modificado";
?>