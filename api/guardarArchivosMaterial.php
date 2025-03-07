<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));

// Verifica que se reciban todos los datos necesarios
if (!isset($obj->id_material) || !isset($obj->nombre) || !isset($obj->archivo) || !isset($obj->ruta)) {
    echo json_encode(["error" => "Faltan parámetros"]);
    exit();
}

// Prepara la consulta SQL para guardar
$stmt = $db->prepare("INSERT INTO archivos_material (id_material, nombre, archivo, ruta, fecha) VALUES (?, ?, ?, ?, NOW())");
$stmt->bind_param('isss', $obj->id_material, $obj->nombre, $obj->archivo, $obj->ruta);

$stmt->execute();
$stmt->close();
echo "Archivo guardado exitosamente";
?>
