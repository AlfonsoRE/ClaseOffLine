<?php
error_reporting(E_ALL);
require_once 'conexion.php';

// Recibir datos enviados desde Angular
$obj = json_decode(file_get_contents("php://input"));
$id_clase = $obj->id ?? null;
$id_usuario = $obj->id_usuario ?? null;

// Validar datos
if (!$id_clase || !$id_usuario) {
    echo json_encode(["error" => "Faltan datos"]);
    exit;
}

// Consulta SQL con el filtro del usuario logueado
$stmt = $db->prepare("
    SELECT 
        t.titulo AS titulo_tema,
        ta.id AS id_tareas,
        ta.titulo,
        ta.valor,
        u.id AS id_usuario,
        u.nombre,
        ht.id AS id_historial,
        ht.id_tareas AS id_tareas_ht,
        ht.calificacion
    FROM temas t
    JOIN tareas ta ON t.id = ta.id_tema
    JOIN clase_estudiantes ce ON ce.id_clase = t.id_clase
    JOIN usuarios u ON u.id = ce.id_estudiante
    LEFT JOIN historial_tareas ht ON ht.id_tareas = ta.id AND ht.id_usuario = u.id
    WHERE t.id_clase = ? 
      AND u.id = ?
    ORDER BY t.id
");

// Enlazar parámetros
$stmt->bind_param('ii', $id_clase, $id_usuario);
$stmt->execute();

// Obtener resultados
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

$mapa = [];
$nombre_tareas = [];

// Agrupación (solo habrá 1 usuario, pero igual lo dejamos limpio)
while ($stmt->fetch()) {

    $mapa[$nombre][] = [
        'titulo_tema' => $titulo_tema,
        'id_tareas' => $id_tareas,
        'titulo' => $titulo,
        'valor' => $valor,
        'id_usuario' => $id_usuario,
        'id_historial' => $id_historial,
        'id_tareas_ht' => $id_tareas_ht,
        'nombre' => $nombre,
        'calificacion' => $calificacion
    ];

    $nombre_tareas[] = $titulo;
}

$stmt->close();

// Títulos únicos de tareas
$nombre_tareas = array_unique($nombre_tareas);

// Respuesta final
echo json_encode([$mapa, $nombre_tareas]);
