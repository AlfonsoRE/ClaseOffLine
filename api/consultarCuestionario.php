<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));

$stmt = $db->prepare("SELECT id, id_tema, titulo, descripcion, id_clase, fecha_creacion FROM cuestionarios WHERE id = ?");
$stmt->bind_param('i', $obj->id);
$stmt->bind_result($id, $id_tema, $titulo, $descripcion, $id_clase, $fecha_creacion);
$stmt->execute();
$arr = array();
if ($stmt->fetch()) {
    $arr[] = array(
        'id' => $id,
        'id_tema' => $id_tema,
        'titulo' => $titulo,
        'descripcion' => $descripcion,
        'id_clase' => $id_clase,
        'fecha_creacion' => $fecha_creacion
    );
}
$stmt->close();
echo json_encode($arr);
?>
