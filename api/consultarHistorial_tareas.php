<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$stmt = $db->prepare("
    select t.titulo as titulo_tema,ta.id as id_tareas,ta.titulo, ta.valor, u.id as id_usuario, u.nombre, ht.id as id_historial, ht.id_tareas as id_tareas_ht, ht.calificacion
    from temas t join tareas ta on t.id = ta.id_tema 
    join clase_estudiantes ce on ce.id_clase = t.id_clase 
    join usuarios u on u.id = ce.id_estudiante 
    left join historial_tareas ht on ht.id_tareas = ta.id and ht.id_usuario = u.id 
    where t.id_clase = ? order by u.nombre, t.id 
");
$obj = json_decode(file_get_contents("php://input"));
$stmt->bind_param('i', $obj->id);
$stmt->execute();
$stmt->bind_result($titulo_tema, $id_tareas, $titulo, $valor, $id_usuario, $nombre, $id_historial, $id_tareas_ht, $calificacion);
$mapa = array();
$nombre_tareas = array();
$informacion  = array();
while ($stmt->fetch()) {
    $arr = array();
    if (array_key_exists($nombre, $mapa)) {
        $arr=$mapa[$nombre];
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
        $mapa[$nombre] =  $arr;
    }else{
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
        $mapa[$nombre] =  $arr;
    }
    $nombre_tareas[] = $titulo;
}
$stmt->close();
$nombre_tareas = array_unique($nombre_tareas);
$informacion[] = $mapa;
$informacion[] = $nombre_tareas;
echo json_encode($informacion);