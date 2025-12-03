<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));

if (!isset($obj->id_tareas)) {
    echo json_encode(["status" => "error", "message" => "ID de tarea no proporcionado"]);
    exit;
}

$stmt = $db->prepare("
    SELECT 
        ht.id,
        ht.id_tareas,
        ht.id_usuario,
        ht.nombre AS nombre_archivo,
        ht.fecha,
        u.nombre AS nombre_usuario
    FROM historial_tareas ht
    INNER JOIN usuarios u ON u.id = ht.id_usuario
    WHERE ht.id_tareas = ?
");

$stmt->bind_param("i", $obj->id_tareas);
$stmt->execute();

$stmt->bind_result(
    $id,
    $id_tareas,
    $id_usuario,
    $nombre_archivo,
    $fecha,
    $nombre_usuario
);

$arr = array();

while ($stmt->fetch()) {
    $arr[] = array(
        'id' => $id,
        'id_tareas' => $id_tareas,
        'id_usuario' => $id_usuario,
        'nombre_usuario' => $nombre_usuario,
        'nombre_archivo' => $nombre_archivo,
        'fecha' => $fecha,
        'url' => '../api/descargarArchivoHistorial.php?id=' . $id
    );
}

$stmt->close();
echo json_encode($arr);
?>
