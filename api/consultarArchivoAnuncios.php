<?php
error_reporting(E_ALL);
require_once 'conexion.php';
$stmt = $db->prepare("SELECT id,id_anuncios,nombre,fecha FROM archivos_anuncios");
$stmt->bind_result($id,$id_anuncios,$nombre,$fecha);
$stmt->execute();
$arr = array();
while($stmt->fetch()){
$arr[] = array('id' =>$id, 
'id_anuncios' =>$id_anuncios,
'nombre' =>$nombre,
'fecha' =>$fecha,
'url'=> '../api/descargarArchivoAnuncio.php?id='.$id
);
}
$stmt->close();
echo json_encode($arr);
?>