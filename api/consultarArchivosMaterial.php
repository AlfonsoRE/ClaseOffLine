<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$stmt = $db->prepare("SELECT id, id_material, nombre, archivo, ruta, fecha FROM archivos_material");
$stmt->bind_result($id, $id_material, $nombre, $archivo, $ruta, $fecha);
$stmt->execute();

$arr = array();
while($stmt->fetch()){
    $arr[] = array(
        'id' => $id,
        'id_material' => $id_material,
        'nombre' => $nombre,
        'archivo' => base64_encode($archivo), // Convierte el archivo a base64 para enviarlo en JSON
        'ruta' => $ruta,
        'fecha' => $fecha
    );
}

$stmt->close();
echo json_encode($arr);
?>
