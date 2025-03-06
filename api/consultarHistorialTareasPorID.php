<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));

$stmt = $db->prepare("SELECT id, id_tareas, id_usuario, calificacion, nombre, ruta, fecha FROM historial_tareas WHERE id = ?");
$stmt->bind_param('i', $obj->id);
$stmt->bind_result($id, $id_tareas, $id_usuario, $calificacion, $nombre, $ruta, $fecha);
$stmt->execute();
$arr = array();
if ($stmt->fetch()) {
    $arr[] = array(
        'id' => $id,
        'id_tareas' => $id_tareas,
        'id_usuario' => $id_usuario,
        'calificacion' => $calificacion,
        'nombre' => $nombre,
        'ruta' => $ruta,
        'fecha' => $fecha,
        'url' => '../api/descargarArchivoHistorial.php?id=' . $id
    );
}
$stmt->close();
echo json_encode($arr);
?>
