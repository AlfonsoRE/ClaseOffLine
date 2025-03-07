<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$stmt = $db->prepare("SELECT id, id_tareas, enlace, fecha FROM enlace_tarea");
$stmt->bind_result($id, $id_tareas, $enlace, $fecha);
$stmt->execute();

$arr = array();
while ($stmt->fetch()) {
    $arr[] = array(
        'id' => $id,
        'id_tareas' => $id_tareas,
        'enlace' => $enlace,
        'fecha' => $fecha,
        'url' => $enlace // Se asume que el enlace ya es una URL
    );
}

$stmt->close();
echo json_encode($arr);
?>
