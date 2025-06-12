<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));
$stmt = $db->prepare("SELECT id, id_material, nombre, archivo, ruta, fecha FROM archivos_material WHERE id_material = ?");
$stmt->bind_param('i', $obj->id_material);
$stmt->bind_result($id, $id_material, $nombre, $archivo, $ruta, $fecha);
$stmt->execute();

$arr = array();
while ($stmt->fetch()) {
    $arr[] = array(
        'id' => $id,
        'id_material' => $id_material,
        'nombre' => $nombre,
        'archivo' => base64_encode($archivo),
        'ruta' => $ruta,
        'fecha' => $fecha,
        'url'=> '../api/descargarArchivoMaterial.php?id='.$id
    );
}

$stmt->close();
echo json_encode($arr);
?>
