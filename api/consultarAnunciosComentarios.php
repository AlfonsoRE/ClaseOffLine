<?php
header("Content-Type: application/json");
require 'conexion.php'; // Conexión a la base de datos

// Obtener datos de la solicitud
$data = json_decode(file_get_contents("php://input"), true);
$id_tarea = isset($data['id_tarea']) ? intval($data['id_tarea']) : 0;


// Verificar que los IDs sean válidos
if ($id_tarea <= 0) {
    echo json_encode(["status" => "error", "message" => "ID de tarea inválido"]);
    exit;
}


// Consulta para obtener comentarios del usuario en la tarea
$sql = "SELECT c.id, c.comentario, c.fecha_comentario, u.nombre, c.id_tarea
        FROM comentarios c
        LEFT JOIN usuarios u ON c.id_usuario = u.id
        WHERE c.id_tarea = ? 
        ORDER BY c.id DESC";

$stmt = $db->prepare($sql);
$stmt->bind_param("i", $id_tarea);
$stmt->execute();

$result = $stmt->get_result(); // obtiene todos los resultados
$anuncios = [];
while ($row = $result->fetch_assoc()) {
    $anuncios[] = $row;
}

echo json_encode([
    "status" => "success",
    "anuncios" => $anuncios
]);
