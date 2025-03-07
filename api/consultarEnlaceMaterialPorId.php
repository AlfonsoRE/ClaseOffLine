<?php
error_reporting(E_ALL);
require_once 'conexion.php'; // Asegúrate de que este archivo contiene la conexión a la base de datos

// Recibe la solicitud JSON
$obj = json_decode(file_get_contents("php://input"));

// Verifica si se recibió el parámetro 'id'
if (!isset($obj->id)) {
    echo json_encode(["status" => "error", "message" => "Falta el parámetro id"]);
    exit;
}

// Prepara la consulta SQL para obtener el registro específico por id
$stmt = $db->prepare("SELECT id, id_material, enlace, fecha FROM enlace_material WHERE id = ?");
$stmt->bind_param('i', $obj->id);
$stmt->execute();
$stmt->bind_result($id, $id_material, $enlace, $fecha);

// Verifica si se encontró el registro
if ($stmt->fetch()) {
    $resultado = [
        "id" => $id,
        "id_material" => $id_material,
        "enlace" => $enlace,
        "fecha" => $fecha,
        "url" => $enlace // Se asume que el enlace es una URL válida
    ];
    echo json_encode($resultado); // Devuelve los datos del enlace en formato JSON
} else {
    echo json_encode(["status" => "error", "message" => "No se encontró el enlace"]); // Si no se encuentra, muestra un mensaje de error
}

// Cierra la consulta
$stmt->close();
?>
