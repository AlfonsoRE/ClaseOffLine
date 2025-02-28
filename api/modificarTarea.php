<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$obj = json_decode(file_get_contents("php://input"));
$stmt = $db->prepare("UPDATE tareas SET id_tema=?, titulo=?, descripcion=?, valor=?, fecha_entrega=? where id=?");
$stmt->bind_param('issdsi', $obj->id_tema, $obj->titulo, $obj->descripcion, $obj->valor, $obj->fecha_entrega,$obj->id);
$stmt->execute();
$stmt->close();
echo "Tarea modificada";
?>