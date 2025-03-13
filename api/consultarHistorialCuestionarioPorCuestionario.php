<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$obj = json_decode(file_get_contents("php://input"));
$stmt = $db->prepare("SELECT id,id_cuestionario,id_usuario,calificacion,fecha FROM historial_cuestionario WHERE id_cuestionario = ?");
$stmt->bind_param('i', $obj->id_cuestionario);
$stmt->bind_result($id,$id_cuestionario,$id_usuario,$calificacion,$fecha);
$stmt->execute();
$arr = array();
while($stmt->fetch()){
$arr[] = array('id' =>$id,
'id_cuestionario' =>$id_cuestionario, 
'id_usuario' =>$id_usuario,
'calificacion' =>$calificacion,
'fecha' =>$fecha,
'url'=> '../api/descargarArchivoTarea.php?id='.$id
);
}
$stmt->close();
echo json_encode($arr);
?>