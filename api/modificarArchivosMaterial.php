<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));

// Verifica que se reciban todos los datos necesarios
if (!isset($obj->id) || !isset($obj->id_material) || !isset($obj->nombre) || !isset($obj->archivo) || !isset($obj->ruta)) {
    echo json_encode(["error" => "Faltan parámetros"]);
    exit();
}

// Prepara la consulta SQL para actualizar
$stmt = $db->prepare("UPDATE archivos_material SET id_material = ?, nombre = ?, archivo = ?, ruta = ? WHERE id = ?");
$stmt->bind_param('isssi', $obj->id_material, $obj->nombre, $obj->archivo, $obj->ruta, $obj->id);

$stmt->execute();
$stmt->close();
echo "Archivo modificado exitosamente";
?>
