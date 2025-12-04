<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$stmt = $db->prepare("
    SELECT 
        t.titulo AS titulo_tema,
        c.id AS id_cuestionario,
        c.titulo AS titulo_cuestionario,
        u.id AS id_usuario,
        u.nombre,
        hc.id AS id_historial,
        hc.id_cuestionario AS id_cuestionario_ht,
        hc.calificacion AS calificacion
    FROM temas t
    JOIN cuestionarios c ON c.id_tema = t.id
    JOIN clase_estudiantes ce ON ce.id_clase = t.id_clase
    JOIN usuarios u ON u.id = ce.id_estudiante
    LEFT JOIN historial_cuestionario hc 
        ON hc.id_cuestionario = c.id AND hc.id_usuario = u.id
    WHERE t.id_clase = ?
    ORDER BY u.nombre, t.id
");

$obj = json_decode(file_get_contents("php://input"));
$stmt->bind_param('i', $obj->id);
$stmt->execute();

$stmt->bind_result(
    $titulo_tema,
    $id_cuestionario,
    $titulo_cuestionario,
    $id_usuario,
    $nombre,
    $id_historial,
    $id_cuestionario_ht,
    $calificacion
);

$mapa = array();
$nombre_tareas = array();
$informacion = array();

while ($stmt->fetch()) {

    if (!array_key_exists($nombre, $mapa)) {
        $mapa[$nombre] = array();
    }

    $mapa[$nombre][] = array(
        'titulo_tema'       => $titulo_tema,
        'id_tareas'         => $id_cuestionario,
        'titulo'            => $titulo_cuestionario,
        'id_usuario'        => $id_usuario,
        'id_historial'      => $id_historial,
        'id_tareas_ht'      => $id_cuestionario_ht,
        'nombre'            => $nombre,
        'calificacion'      => $calificacion
    );

    $nombre_tareas[] = $titulo_cuestionario;
}

$stmt->close();

$nombre_tareas = array_unique($nombre_tareas);
$informacion[] = $mapa;
$informacion[] = $nombre_tareas;

echo json_encode($informacion);
