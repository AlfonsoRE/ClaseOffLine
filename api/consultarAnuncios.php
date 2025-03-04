<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$stmt = $db->prepare("SELECT id,id_clase,mensaje,fecha FROM anuncios");
$stmt->bind_result($id,$id_clase,$mensaje,$fecha);
$stmt->execute();
$arr = array();
while($stmt->fetch()){
$arr[] = array('id' =>$id, 
'clase' =>$id_clase,
'mensaje' =>$mensaje,
'fecha' =>$fecha
);
}
$stmt->close();
echo json_encode($arr);
?>