<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));

if (!isset($obj->id)) {
    echo json_encode(["status" => "error", "message" => "Falta el parámetro id"]);
    exit;
}

$stmt = $db->prepare("SELECT id, id_tareas, enlace, fecha FROM enlace_tarea WHERE id = ?");
$stmt->bind_param('i', $obj->id);
$stmt->execute();
$stmt->bind_result($id, $id_tareas, $enlace, $fecha);

if ($stmt->fetch()) {
    $resultado = [
        "id" => $id,
        "id_tareas" => $id_tareas,
        "enlace" => $enlace,
        "fecha" => $fecha,
        "url" => $enlace // Se asume que el enlace es una URL válida
    ];
    echo json_encode($resultado);
} else {
    echo json_encode(["status" => "error", "message" => "No se encontró el enlace"]);
}

$stmt->close();
?>
