<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));

$stmt = $db->prepare("SELECT id, id_tareas, nombre, fecha FROM historial_tareas WHERE id_tareas = ? AND id_usuario = ? AND nombre IS NOT NULL AND nombre <> ''");

$stmt->bind_param('ii', $obj->id_tareas, $obj->id_usuario);
$stmt->bind_result($id, $id_tareas, $nombre, $fecha);
$stmt->execute();

$arr = array();
while ($stmt->fetch()) {
    $arr[] = array(
        'id' => $id,
        'id_tareas' => $id_tareas,
        'nombre' => $nombre,
        'fecha' => $fecha,
        'url' => '../api/descargarArchivoHistorial.php?id=' . $id
    );
}

$stmt->close();
echo json_encode($arr);
