<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$stmt = $db->prepare("SELECT id,id_clase, id_estudiante, status, fecha_inscripcion FROM clase_estudiantes");
$stmt->bind_result($id,$id_clase,$id_estudiante,$status,$fecha_inscripcion);
$stmt->execute();
$arr = array();
while($stmt->fetch()){
$arr[] = array('id' =>$id, 
'id_clase' =>$id_clase,
'id_estudiante' =>$id_estudiante,
'status' =>$status,
'fecha_inscripcion' =>$fecha_inscripcion,
);
}
$stmt->close();
echo json_encode($arr);
?>