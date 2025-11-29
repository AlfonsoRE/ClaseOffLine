<?php
header("Content-Type: application/json");
require_once 'conexion.php';

// Obtener datos enviados por POST
$data = json_decode(file_get_contents("php://input"), true);

$id_tarea = isset($data['id_tarea']) ? intval($data['id_tarea']) : 0;
$id_usuario = isset($data['id_usuario']) ? intval($data['id_usuario']) : 0;

// Validación básica
if ($id_tarea <= 0) {
    echo json_encode(["status" => "error", "message" => "ID de tarea inválido"]);
    exit;
}

/*
    Consulta optimizada:

    - Obtiene TODOS los comentarios de la tarea
    - Obtiene el nombre del usuario que hizo cada comentario
    - Ordena de más nuevo a más viejo
*/

$sql = "
    SELECT c.id, c.id_usuario, c.id_tarea, c.comentario, c.fecha_comentario,
           u.nombre
    FROM comentarios c
    INNER JOIN usuarios u ON u.id = c.id_usuario
    WHERE c.id_tarea = ?
    ORDER BY c.id DESC
";

$stmt = $db->prepare($sql);
$stmt->bind_param("i", $id_tarea);
$stmt->execute();
$result = $stmt->get_result();

$comentarios = [];

while ($row = $result->fetch_assoc()) {
    $comentarios[] = $row;
}

echo json_encode($comentarios);
$stmt->close();
?>
