<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$stmt = $db->prepare("SELECT id, id_tema, titulo, descripcion, id_clase, fecha_creacion FROM cuestionarios");
$stmt->bind_result($id, $id_tema, $titulo, $descripcion, $id_clase, $fecha_creacion);
$stmt->execute();
$arr = array();
while ($stmt->fetch()) {
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
