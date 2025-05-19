<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$obj = json_decode(file_get_contents("php://input")); 
$stmt = $db->prepare("INSERT INTO tareas (id_tema, titulo, descripcion, valor, fecha, fecha_entrega, id_clase)  VALUES (?, ?, ?, ?, NOW(), ?, ?)");
$stmt->bind_param('issdsi', $obj->id_tema, $obj->titulo, $obj->descripcion, $obj->valor, $obj->fecha_entrega, $obj->id_clase);
$stmt->execute();
$id_generado = $db->insert_id;
$stmt->close();
echo $id_generado;
?>