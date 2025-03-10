<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$stmt = $db->prepare("SELECT id, id_tarea, id_usuario, comentario, fecha_comentario FROM comentarios");
$stmt->execute();
$stmt->bind_result($id, $id_tarea, $id_usuario, $comentario, $fecha_comentario);

$arr = array();
while ($stmt->fetch()) {
    $arr[] = array(
        'id' => $id,
        'id_tarea' => $id_tarea,
        'id_usuario' => $id_usuario,
        'comentario' => $comentario,
        'fecha_comentario' => $fecha_comentario
    );
}

$stmt->close();
echo json_encode($arr);
?>
