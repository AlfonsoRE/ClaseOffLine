<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$obj = json_decode(file_get_contents("php://input"));

$stmt = $db->prepare("SELECT id,id_usuario, id_tarea, (select nombre from usuarios where id= ? ) as nombre , comentario, fecha_comentario FROM comentarios WHERE id_tarea = ? order by id  desc");
$stmt->bind_param('ii', $obj->id_usuario, $obj->id_tarea);
$stmt->execute();
$stmt->bind_result($id,$id_usuario, $id_tarea,  $nombre, $comentario, $fecha_comentario);

$arr = array();
while ($stmt->fetch()) {
    $arr[] = array(
        'id' => $id,
        'id_usuario' => $id_usuario,
        'id_tarea' => $id_tarea,
        'nombre' => $nombre,
        'comentario' => $comentario,
        'fecha_comentario' => $fecha_comentario
    );
}

$stmt->close();
echo json_encode($arr);
?>
