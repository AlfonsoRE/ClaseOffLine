<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$stmt = $db->prepare("
    select 
        u.nombre as titulo_tema,
        hc.id as id_tareas,
        c.titulo as titulo,
        hc.calificacion as valor,
        u.id as id_usuario,
        u.nombre,
        hc.id as id_historial,
        hc.id_cuestionario as id_tareas_ht,
        hc.calificacion as calificacion
    from historial_cuestionario hc 
    join usuarios u on u.id = hc.id_usuario
    join cuestionarios c on c.id = hc.id_cuestionario
    order by u.nombre, hc.id_cuestionario
");

$obj = json_decode(file_get_contents("php://input"));
$stmt->execute();
$stmt->bind_result($titulo_tema, $id_tareas, $titulo, $valor, $id_usuario, $nombre, $id_historial, $id_tareas_ht, $calificacion);

$mapa = array();
$nombre_tareas = array();
$informacion  = array();

while ($stmt->fetch()) {
    $arr = array();
    if (array_key_exists($nombre, $mapa)) {
        $arr = $mapa[$nombre];
        $arr[] = array(
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
        $mapa[$nombre] = $arr;
    } else {
        $arr[] = array(
            'titulo_tema' => $titulo_tema,
            'id_tareas' => $id_tareas,
            'titulo' => $titulo,
            'valor' => $valor,
            'id_usuario' => $id_usuario,
            'id_historial' => $id_historial,
            'id_tareas' => $id_tareas,
            'nombre' => $nombre,
            'calificacion' => $calificacion
        );
        $mapa[$nombre] = $arr;
    }
    $nombre_tareas[] = $titulo;
}

$stmt->close();
$nombre_tareas = array_unique($nombre_tareas);
$informacion[] = $mapa;
$informacion[] = $nombre_tareas;
echo json_encode($informacion);
