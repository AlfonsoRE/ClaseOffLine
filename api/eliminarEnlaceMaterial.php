<?php
error_reporting(E_ALL);
require_once 'conexion.php';

$obj = json_decode(file_get_contents("php://input"));

// Verificar que se haya recibido el parámetro "id"
if (!isset($obj->id)) {
    echo json_encode(["status" => "error", "message" => "Falta el parámetro id"]);
    exit;
}

// Preparar la consulta para eliminar el registro de enlace_material por el id proporcionado
$stmt = $db->prepare("DELETE FROM enlace_material WHERE id = ?");

// Vincular el parámetro "id" y ejecutarlo
$stmt->bind_param('i', $obj->id);
$stmt->execute();

// Cerrar la consulta
$stmt->close();

echo "Registro eliminado";
?>
