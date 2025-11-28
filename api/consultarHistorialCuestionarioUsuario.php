<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));

// Asegúrate de que envíes id_usuario e id_cuestionario
$id_usuario = $obj->id_usuario;
$id_cuestionario = $obj->id_cuestionario;

$stmt = $db->prepare("
    SELECT c.id, c.titulo, c.descripcion, c.fecha_creacion, hc.calificacion
    FROM cuestionarios c
    LEFT JOIN historial_cuestionario hc 
        ON hc.id_cuestionario = c.id AND hc.id_usuario = ?
    WHERE c.id = ?
    LIMIT 1
");

$stmt->bind_param("ii", $id_usuario, $id_cuestionario);
$stmt->execute();
$stmt->bind_result($id, $titulo, $descripcion, $fecha_creacion, $calificacion);

$cuestionario = array();
if ($stmt->fetch()) {
    $cuestionario = array(
        'id' => $id,
        'titulo' => $titulo,
        'descripcion' => $descripcion,
        'fecha_creacion' => $fecha_creacion,
        'calificacion' => $calificacion 
    );
}

$stmt->close();
echo json_encode($cuestionario);
