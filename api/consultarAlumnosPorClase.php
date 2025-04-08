<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));

$stmt = $db->prepare("SELECT ce.id, ce.id_clase, ce.id_estudiante, u.nombre, ce.status, ce.fecha_inscripcion 
                      FROM clase_estudiantes ce
                      INNER JOIN usuarios u ON ce.id_estudiante = u.id
                      WHERE ce.id_clase = ?");
$stmt->bind_param('i', $obj->id_clase);
$stmt->execute();
$stmt->bind_result($id, $id_clase, $id_estudiante, $nombre, $status, $fecha_inscripcion);

$arr = array();
while ($stmt->fetch()) {
  $arr[] = array(
    'id' => $id,
    'id_clase' => $id_clase,
    'id_estudiante' => $id_estudiante,
    'nombre' => $nombre,
    'status' => $status,
    'fecha_inscripcion' => $fecha_inscripcion
  );
}

$stmt->close();
echo json_encode($arr);
