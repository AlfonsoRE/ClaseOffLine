<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$stmt = $db->prepare("SELECT id,id_tareas,nombre,fecha FROM archivos_tarea");
$stmt->bind_result($id,$id_tareas,$nombre,$fecha);
$stmt->execute();
$arr = array();
while($stmt->fetch()){
$arr[] = array(
'id' =>$id, 
'id_tareas' =>$id_tareas,
'nombre' =>$nombre,
'fecha' =>$fecha,
'url'=> '../api/descargarArchivoTarea.php?id='.$id
);
}
$stmt->close();
echo json_encode($arr);
?>