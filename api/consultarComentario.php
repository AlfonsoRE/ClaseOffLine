<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$obj = json_decode(file_get_contents("php://input")); 

$stmt = $db->prepare("SELECT id, id_tarea, id_usuario, comentario, fecha_comentario FROM comentarios 
WHERE id = ?");
$stmt->bind_param('i', $obj->id);
$stmt->bind_result($id, $id_tarea, $id_usuario, $comentario, $fecha_comentario);
$stmt->execute();
$arr = array();

if ($stmt->fetch()) {
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
