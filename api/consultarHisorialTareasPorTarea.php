<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));

if (!isset($obj->id_tareas)) {
    echo json_encode(["status" => "error", "message" => "ID de tarea no proporcionado"]);
    exit;
}

$stmt = $db->prepare("SELECT id, id_tareas, id_usuario, nombre, fecha FROM historial_tareas WHERE id_tareas = ?");
$stmt->bind_param('i', $obj->id_tareas);
$stmt->execute();
$stmt->bind_result($id, $id_tareas, $id_usuario, $nombre, $fecha);

$arr = array();
while ($stmt->fetch()) {
    $arr[] = array(
        'id' => $id,
        'id_tareas' => $id_tareas,
        'id_usuario' => $id_usuario,
        'nombre' => $nombre,
        'fecha' => $fecha,
        'url' => '../api/descargarArchivoHistorial.php?id=' . $id // Ajusta según tu script de descarga
    );
}
$stmt->close();
echo json_encode($arr);
?>
