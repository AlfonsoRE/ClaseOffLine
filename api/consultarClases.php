<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$stmt = $db->prepare("SELECT id,nombre,materia, descripcion, codigo, id_usuario FROM clases");
$stmt->bind_result($id,$nombre,$materia,$descripcion,$codigo,$id_usuario);
$stmt->execute();
$arr = array();
while($stmt->fetch()){
$arr[] = array('id' =>$id, 
'nombre' =>$nombre,
'materia' =>$materia,
'descripcion' =>$descripcion,
'codigo' =>$codigo,
'id_usuario' =>$id_usuario,
);
}
$stmt->close();
echo json_encode($arr);
?>