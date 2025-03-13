<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));

if (!isset($obj->id_tareas)) {
    echo json_encode(["status" => "error", "message" => "Falta el parámetro id_tareas"]);
    exit;
}

$stmt = $db->prepare("SELECT id, id_tareas, enlace, fecha FROM enlace_tarea WHERE id_tareas = ?");
$stmt->bind_param('i', $obj->id_tareas);
$stmt->bind_result($id, $id_tareas, $enlace, $fecha);
$stmt->execute();

$arr = array();
while ($stmt->fetch()) {
    $arr[] = array(
        'id' => $id,
        'id_tareas' => $id_tareas,
        'enlace' => $enlace,
        'fecha' => $fecha,
        'url' => $enlace // Se asume que el enlace es una URL válida
    );
}

$stmt->close();
echo json_encode($arr);
?>
