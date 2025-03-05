<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));

$stmt = $db->prepare("SELECT id, id_cuestionario, pregunta, opcion1, opcion2, opcion3,  opcion4, respuesta, fecha_creacion FROM cuestionarios_contenido WHERE id_cuestionario = ?");
$stmt->bind_param('i', $obj->id_cuestionario);
$stmt->bind_result($id, $id_cuestionario, $pregunta, $opcion1, $opcion2, $opcion3, $opcion4, $respuesta, $fecha_creacion);
$stmt->execute();
$arr = array();
if ($stmt->fetch()) {
    $arr[] = array(
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
?>
