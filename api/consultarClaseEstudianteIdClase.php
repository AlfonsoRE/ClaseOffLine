<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$obj = json_decode(file_get_contents("php://input")); 
$stmt = $db->prepare("SELECT id, id_clase, id_estudiante, status, fecha_inscripcion, 
(select nombre from usuarios where id = id_estudiante ) as nombre FROM clase_estudiantes WHERE id_clase = ? order by nombre");
$stmt->bind_param('i',  $obj->id_clase);
$stmt->bind_result($id, $id_clase, $id_estudiante, $status, $fecha_inscripcion, $nombre);
$stmt->execute();
$arr = array();
while($stmt->fetch()){
$arr[] = array(
'id' => $id, 
'id_clase' => $id_clase,
'id_estudiante' => $id_estudiante,
'status' => $status,
'fecha_inscripcion' => $fecha_inscripcion,
'nombre' => $nombre
);
}
$stmt->close();
echo json_encode($arr);
?>