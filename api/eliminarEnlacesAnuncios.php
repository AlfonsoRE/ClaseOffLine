<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));

// Verifica que se reciba el ID
if (!isset($obj->id)) {
    echo json_encode(["error" => "Falta el id"]);
    exit();
}

// Prepara la consulta SQL para eliminar
$stmt = $db->prepare("DELETE FROM enlaces_anuncios WHERE id = ?");

if (!$stmt) {
    echo json_encode(["error" => "Error en la preparación de la consulta"]);
    exit();
}

// Asigna el parámetro y ejecuta
$stmt->bind_param('i', $obj->id);
$stmt->execute();
$stmt->close();

echo "Registro eliminado";
?>
