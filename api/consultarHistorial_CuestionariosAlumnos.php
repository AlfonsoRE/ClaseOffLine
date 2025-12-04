<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));
$id_usuario = $obj->id_usuario ?? null;

if (!$id_usuario) {
    echo json_encode(["error" => "Falta id_usuario"]);
    exit;
}

/*
  IMPORTANTE:
  Se usa LEFT JOIN para traer TODOS los cuestionarios,
  y solo el historial del usuario si existe.
*/

$stmt = $db->prepare("
    SELECT 
        u.nombre AS titulo_tema,
        c.id AS id_tareas,
        c.titulo AS titulo,
        hc.calificacion AS valor,
        u.id AS id_usuario,
        u.nombre,
        hc.id AS id_historial,
        hc.id_cuestionario AS id_tareas_ht,
        hc.calificacion AS calificacion
    FROM usuarios u
    JOIN clase_estudiantes ce ON ce.id_estudiante = u.id
    JOIN clases cl ON cl.id = ce.id_clase
    JOIN temas t ON t.id_clase = cl.id
    JOIN cuestionarios c ON c.id_tema = t.id
    LEFT JOIN historial_cuestionario hc 
           ON hc.id_cuestionario = c.id
           AND hc.id_usuario = u.id
    WHERE u.id = ? AND cl.id = ?
    ORDER BY c.id ASC
");

$stmt->bind_param("ii", $id_usuario, $obj->id);
$stmt->execute();

$stmt->bind_result(
    $titulo_tema, 
    $id_tareas, 
    $titulo, 
    $valor, 
    $id_usuario, 
    $nombre, 
    $id_historial, 
    $id_tareas_ht, 
    $calificacion
);

$mapa = array();
$nombre_tareas = array();
$informacion = array();

while ($stmt->fetch()) {

    if (array_key_exists($nombre, $mapa)) {

        $mapa[$nombre][] = array(
            'titulo_tema' => $titulo_tema,
            'id_tareas' => $id_tareas,
            'titulo' => $titulo,
            'valor' => $valor,
            'id_usuario' => $id_usuario,
            'id_historial' => $id_historial,
            'id_tareas_ht' => $id_tareas_ht,
            'nombre' => $nombre,
            'calificacion' => $calificacion
        );

    } else {

        $mapa[$nombre] = array(
            array(
                'titulo_tema' => $titulo_tema,
                'id_tareas' => $id_tareas,
                'titulo' => $titulo,
                'valor' => $valor,
                'id_usuario' => $id_usuario,
                'id_historial' => $id_historial,
                'id_tareas_ht' => $id_tareas_ht,
                'nombre' => $nombre,
                'calificacion' => $calificacion
            )
        );
    }

    $nombre_tareas[] = $titulo;
}

$stmt->close();

$nombre_tareas = array_unique($nombre_tareas);

$informacion[] = $mapa;
$informacion[] = $nombre_tareas;

echo json_encode($informacion);
