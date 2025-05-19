<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$stmt = $db->prepare("
    SELECT ht.id, ht.id_tareas, ht.id_usuario, u.nombre AS estudiante, 
           t.titulo AS titulo_tarea, t.descripcion AS descripcion_tarea, 
           t.fecha_entrega, ht.fecha, ht.calificacion
    FROM historial_tareas ht
    JOIN usuarios u ON ht.id_usuario = u.id
    JOIN tareas t ON ht.id_tareas = t.id
    WHERE t.id_clase = ?
");

$obj = json_decode(file_get_contents("php://input"));
$stmt->bind_param('i', $obj->id);
$stmt->execute();
$stmt->bind_result($id, $id_tareas, $id_usuario, $estudiante, $titulo_tarea, $descripcion_tarea, $fecha_entrega, $fecha, $calificacion);

$arr = array();
while ($stmt->fetch()) {
    $arr[] = array(
        'id' => $id,
        'id_tareas' => $id_tareas,
        'id_usuario' => $id_usuario,
        'estudiante' => $estudiante,
        'titulo_tarea' => $titulo_tarea,
        'descripcion_tarea' => $descripcion_tarea,
        'fecha_entrega' => $fecha_entrega,
        'fecha' => $fecha,
        'calificacion' => $calificacion
    );
}
$stmt->close();
echo json_encode($arr);
