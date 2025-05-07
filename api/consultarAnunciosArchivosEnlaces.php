<?php
header("Content-Type: application/json");
require 'conexion.php'; // Asegúrate de que tienes la conexión a la BD

// Obtener datos de la solicitud
$data = json_decode(file_get_contents("php://input"), true);
$id_clase = isset($data['id_clase']) ? intval($data['id_clase']) : 0;

// Verificar que el id_clase sea válido
if ($id_clase <= 0) {
    echo json_encode(["status" => "error", "message" => "ID de clase inválido"]);
    exit;
}
//echo "holaaaaaa ".$id_clase;
//$response = ["status" => "success", "anuncios" => []];

// Obtener anuncios con el nombre del usuario
$sql = "SELECT a.id, a.mensaje, a.fecha, u.nombre,a.id_usuario  
        FROM anuncios a
        LEFT JOIN usuarios u ON a.id_usuario = u.id
        WHERE a.id_clase = ? order by a.id desc";
$stmt = $db->prepare($sql);
$stmt->bind_param("i", $id_clase);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $anuncio_id = $row["id"];

    // Obtener archivos relacionados con este anuncio
    $sql_archivos = "SELECT id, nombre, ruta FROM archivos_anuncios WHERE id_anuncios = ?";
    $stmt_archivos = $db->prepare($sql_archivos);
    $stmt_archivos->bind_param("i", $anuncio_id);
    $stmt_archivos->execute();
    $result_archivos = $stmt_archivos->get_result();
    $archivos = [];
    while ($archivo = $result_archivos->fetch_assoc()) {
        $archivos[] = $archivo;
    }

    // Obtener enlaces relacionados con este anuncio
    $sql_enlaces = "SELECT id, enlace FROM enlaces_anuncios WHERE id_anuncios = ?";
    $stmt_enlaces = $db->prepare($sql_enlaces);
    $stmt_enlaces->bind_param("i", $anuncio_id);
    $stmt_enlaces->execute();
    $result_enlaces = $stmt_enlaces->get_result();
    $enlaces = [];
    while ($enlace = $result_enlaces->fetch_assoc()) {
        $enlaces[] = $enlace;
    }

    // Agregar anuncio con archivos y enlaces
    $response[] = [
        "id" => $row["id"],
        "mensaje" => $row["mensaje"],
        "fecha" => $row["fecha"],
        "nombre" => $row["nombre"],
        "id_usuario" => $row["id_usuario"],
        "archivos" => $archivos,
        "enlaces" => $enlaces
    ];
}

// Enviar respuesta JSON
echo json_encode($response);
?>