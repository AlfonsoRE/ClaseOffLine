<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$obj = json_decode(file_get_contents("php://input"));

// Primero, obtenemos los datos del cuestionario
$stmt1 = $db->prepare("SELECT id, id_tema, titulo, descripcion, id_clase, fecha_creacion FROM cuestionarios WHERE id = ?");
$stmt1->bind_param('i', $obj->id_cuestionario);
$stmt1->bind_result($id, $id_tema, $titulo, $descripcion, $id_clase, $fecha_creacion);
$stmt1->execute();
$stmt1->fetch();
$stmt1->close();

$cuestionario = array(
    'id' => $id,
    'id_tema' => $id_tema,
    'titulo' => $titulo,
    'descripcion' => $descripcion,
    'id_clase' => $id_clase,
    'fecha_creacion' => $fecha_creacion
);
// Obtener id desde GET

$stmt = $db->prepare("SELECT id, id_cuestionario, pregunta, opcion1, opcion2, opcion3, opcion4, respuesta, fecha_creacion FROM cuestionarios_contenido WHERE id_cuestionario = ?");
$stmt->bind_param('i', $obj->id_cuestionario);
$stmt->bind_result($id, $id_cuestionario, $pregunta, $opcion1, $opcion2, $opcion3, $opcion4, $respuesta, $fecha_creacion);
$stmt->execute();

$preguntas = array();
while ($stmt->fetch()) {
    $preguntas[] = array(
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

echo json_encode(array(
    'cuestionario' => $cuestionario,
    'preguntas' => $preguntas
));
