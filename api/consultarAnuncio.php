<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$obj = json_decode(file_get_contents("php://input")); 
$stmt = $db->prepare("SELECT id,id_clase,mensaje,fecha FROM anuncios 
WHERE id = ?");
$stmt->bind_param('i',$obj->id);
$stmt->bind_result($id,$id_clase,$mensaje,$fecha);
$stmt->execute();
$arr = array();
if($stmt->fetch()){
$arr[] = array('id' =>$id, 
'id_clase' =>$id_clase,
'mensaje' =>$mensaje,
'fecha' =>$fecha
);
}
$stmt->close();
echo json_encode($arr);
?>