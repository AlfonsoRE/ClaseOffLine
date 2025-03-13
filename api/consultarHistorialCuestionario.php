<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));

$stmt = $db->prepare("SELECT id, id_cuestionario, id_usuario, calificacion,fecha FROM historial_cuestionario WHERE id = ?");
$stmt->bind_param('i', $obj->id);
$stmt->bind_result($id, $id_cuestionario, $id_usuario, $calificacion,$fecha);
$stmt->execute();
$arr = array();
if ($stmt->fetch()) {
    $arr[] = array(
        'id' => $id,
        'id_cuestionario' => $id_cuestionario,
        'id_usuario' => $id_usuario,
        'calificacion' => $calificacion,
        'fecha' => $fecha
      
    );
}
$stmt->close();
echo json_encode($arr);
?>
