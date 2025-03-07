<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));

// Verifica que se reciban los datos necesarios
if (!isset($obj->id) || !isset($obj->id_anuncios) || !isset($obj->enlace)) {
    echo json_encode(["error" => "Faltan datos requeridos"]);
    exit();
}

// Prepara la consulta SQL para actualizar
$stmt = $db->prepare("UPDATE enlaces_anuncios SET id_anuncios=?, enlace=? WHERE id=?");

if (!$stmt) {
    echo json_encode(["error" => "Error en la preparación de la consulta"]);
    exit();
}

// Asigna los parámetros y ejecuta
$stmt->bind_param('isi', $obj->id_anuncios, $obj->enlace, $obj->id);
$stmt->execute();
$stmt->close();

echo "Registro modificado";
?>
