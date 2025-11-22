<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$stmt = $db->prepare("SELECT id,id_tema,titulo,descripcion, valor, fecha, fecha_entrega, id_clase FROM tareas");
$stmt->bind_result($id, $id_tema, $titulo, $descripcion, $valor, $fecha, $fecha_entrega, $id_clase);
$stmt->execute();
$arr = array();
while ($stmt->fetch()) {
    $arr[] = array(
        'id' => $id,
        'id_tema' => $id_tema,
        'titulo' => $titulo,
        'descripcion' => $descripcion,
        'valor' => $valor,
        'fecha' => $fecha,
        'fecha_entrega' => $fecha_entrega,
        'id_clase' => $id_clase
    );
}
$stmt->close();
echo json_encode($arr);
