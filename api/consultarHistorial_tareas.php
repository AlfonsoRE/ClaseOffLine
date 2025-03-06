<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$stmt = $db->prepare("SELECT id, id_tareas, id_usuario, nombre, fecha, ruta FROM historial_tareas");
$stmt->execute();
$stmt->bind_result($id, $id_tareas, $id_usuario, $nombre, $fecha, $ruta);

$arr = array();
while ($stmt->fetch()) {
    $arr[] = array(
        'id' => $id,
        'id_tareas' => $id_tareas,
        'id_usuario' => $id_usuario,
        'nombre' => $nombre,
        'fecha' => $fecha,
        'url' => '../api/descargarArchivoHistorial.php?id=' . $id // Ajusta el script de descarga según tu implementación
    );
}
$stmt->close();
echo json_encode($arr);
?>
