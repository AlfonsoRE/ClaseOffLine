<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));

$stmt = $db->prepare("INSERT INTO cuestionarios(id_tema, titulo, descripcion, id_clase) VALUES(?, ?, ?, ?)");
$stmt->bind_param('issi', $obj->id_tema, $obj->titulo, $obj->descripcion, $obj->id_clase);
$stmt->execute();

$id_insertado = $db->insert_id;

$stmt->close();

// Devolver el ID del nuevo cuestionario
echo json_encode(["id" => $id_insertado]);
