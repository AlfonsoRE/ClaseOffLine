<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$stmt = $db->prepare("SELECT id,titulo,descripcion, id_tema FROM material");
$stmt->bind_result($id,$titulo,$descripcion,$id_tema);
$stmt->execute();
$arr = array();
while($stmt->fetch()){
$arr[] = array('id' =>$id, 
'titulo' =>$titulo,
'descripcion' =>$descripcion,
'id_tema' =>$id_tema,
);
}
$stmt->close();
echo json_encode($arr);
?>