<?php
error_reporting(E_ALL);
require_once 'conexion.php';

// Obtener id desde GET
$id_cuestionario = isset($_GET['id_cuestionario']) ? intval($_GET['id_cuestionario']) : 0;

$stmt = $db->prepare("SELECT id, id_cuestionario, pregunta, opcion1, opcion2, opcion3, opcion4, respuesta, fecha_creacion FROM cuestionarios_contenido WHERE id_cuestionario = ?");
$stmt->bind_param('i', $id_cuestionario);
$stmt->execute();
$stmt->bind_result($id, $id_cuestionario, $pregunta, $opcion1, $opcion2, $opcion3, $opcion4, $respuesta, $fecha_creacion);

$arr = array();
if ($stmt->fetch()) {
    $arr = array(
        'id' => $id,
        'id_cuestionario' => $id_cuestionario,
        'pregunta' => $pregunta,
        'opcion1' => $opcion1,
        'opcion2' => $opcion2,
        'opcion3' => $opcion3,
        'opcion4' => $opcion4,
        'respuesta' => $respuesta,
        'fecha_creacion' => $fecha_creacion
    );
}
$stmt->close();

echo json_encode($arr);
